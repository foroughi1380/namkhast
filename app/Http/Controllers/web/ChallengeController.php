<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\IdPayPayment;
use App\Http\Requests\CreateChallengeRequest;
use App\Models\Challenge;
use App\Models\Config;
use App\Models\Contributors;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Nette\Schema\ValidationException;
use phpDocumentor\Reflection\Types\Integer;
use function PHPUnit\Framework\isReadable;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render("Web/myChallenge" , [
            "chs" => (new Challenge())->parseQueries($request)->where("user_id" , Auth::id())->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render("Web/challengeCreate" , [
            "participantPrices" => Config::get("challenge_pp"),
            "challengeCategories" => Config::get("challenge_group"),
            "minBudget" => Config::get("min_coast_budget"),
            "maxBudget" => Config::get("max_coast_budget")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(CreateChallengeRequest $request)
    {
        $challenge = new Challenge();
        $challenge->user_id = Auth::user()->id;

        $challenge->title = $request->get('title');
        $challenge->description = $request->get('description');
        $challenge->started_at = $request->get('startDate');
        $challenge->expiration_at = $request->get("endDate");
        $challenge->type = $request->get('isCost') ? "nonfree": "free";
        $challenge->budget = $request->get('budget');
        $challenge->category = $request->get('category');

        if ($request->get('isCost')){
            $challenge->cost = $request->get('costPrice');
        }

        if ($request->hasFile('picture')){
            $challenge->picture = $request->file("picture")->store("challenge/picture");
        }

        if ($request->hasFile('document')){
            $challenge->document = $request->file("document")->store("challenge/document");
        }

        if ($challenge->save()){
            return redirect(route("challenge.edit" , [$challenge->id]));
        }else{
            throw \Illuminate\Validation\ValidationException::withMessages([
                "unknown" => "خطایی در ذخیره اطلاعات رخ داده است."
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $challenge = Challenge::query()->where('status' , 'paid')->findOrFail($id);

        $winnerUser = '';
        if($challenge->winner_user){
            $winnerUser = User::query()->find($challenge->winner_user);
        }

        $contributors = Contributors::query()->where('challenge_id' , $id)->whereNotNull('suggested_name')->get();

        $users = User::all();

        return Inertia::render("Web/challengeDetail" , [
            "challenge" => $challenge,
            "winnerUser" => $winnerUser,
            "contributors" => $contributors,
            "users" => $users
        ]);
    }

    public function suggestDetail($id){
        $suggest = Contributors::query()->findOrFail($id);
        $user = User::query()->find($suggest->user_id);

        return Inertia::render("Web/suggestDetail" , [
            "suggest" => $suggest,
            "sugUser" => $user
        ]);
    }

    public function choiceWinner($id , Request $request){
        $request->validate([
            "token" => "required|captcha:choiceWinner"
        ]);

        $suggest = Contributors::query()->find($id);
        $challenge = Challenge::query()->find($suggest->challenge_id);
        $challenge->winner_user = $request->get('winnerUser');
        if (! $challenge->mine){
            throw \Illuminate\Validation\ValidationException::withMessages([
                "unknown" => "این چالش متعلق به شما نیست."
            ]);
        }
        $challenge->ended_at = now();
        $challenge->save();

        $wallet = new Wallet();
        $wallet->user_id = $challenge->winner_user;
        $wallet->price = $challenge->budget;
        $wallet->save();

        return redirect(route("challenge.show" , [$challenge->id]));
    }


    public function contributor(Challenge $challenge)
    {
        if ($challenge->is_Contributor){
            return Inertia::render("Web/challengeParticipants" , [
               "contributor" => Contributors::query()->where("user_id" , Auth::id())->where("challenge_id" , $challenge->id)->first(),
               "challenge" => $challenge
            ]);
        }

        if ($challenge->type == "free"){
            $cont = new Contributors();
            $cont->user_id = Auth::id();
            $cont->challenge_id = $challenge->id;
            $cont->save();
            return $this->show($challenge->id);
        }else{
            $payment = IdPayPayment::create($challenge->cost , ["for" => Contributors::class , "user_id" => Auth::id() , "challenge_id" => $challenge->id]);
            if ($payment){
                return redirect($payment->link);
            }else{
                throw \Illuminate\Validation\ValidationException::withMessages([
                    "unknown" => "خطایی در ارتباط با درگاه پرداخت داده رخ داده است."
                ]);
            }
        }
    }

    public function contributorUpdate(Contributors $cont , Request $request)
    {
        if ($cont->user_id != Auth::id()) exit(403);

        $request->validate([
            "name" => "required|string|min:3" ,
            "description" => "nullable|string" ,
            "sound" => "file|max:1000",
            "token" => "required|captcha:cup"
        ] , [
            "name.*" => "نام باید حد اقل ۳ کراکتر باشد",
            "sound.*" => "حجم فایل باید کمتر از ۱ مگابایت باشد"
        ]);


        $cont->suggested_name = $request->get("name");
        $cont->description = $request->get("description" , $cont->description);

        if ($request->hasFile("sound")){
            if ($cont->sound){
                Storage::delete($cont->sound);
            }
            $cont->sound = $request->file("sound")->store("sounds/");
        }


        if($cont->save()){
            return Inertia::render("Web/challengeParticipants" , [
                "contributor" => Contributors::query()->where("user_id" , Auth::id())->where("challenge_id" , $cont->challenge_id)->first(),
                "challenge" => Challenge::query()->find($cont->challenge_id)
            ]);
        }else{
            throw \Illuminate\Validation\ValidationException::withMessages([
                "unknown" => "خطایی در ارتباط با درگاه پرداخت داده رخ داده است."
            ]);
        }
    }
    public function contributorChallenges(Request $request)
    {
        return Inertia::render("Web/myChallenge" , [
            "chs" => (new Challenge())->parseQueries($request)->selectRaw("challenge.*")->join('contributors', function ($join) {
                    $join->on("challenge.id" , "=" , 'contributors.challenge_id');
                    $join->where('contributors.user_id', '=', Auth::id());
                })->paginate(5),
            "myTitle" => "چالش های شرکت شده "
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Challenge $challenge)
    {
        if (! $challenge->mine){
            exit(403);
        }

        return Inertia::render("Web/challengeCreate" , [
            "participantPrices" => Config::get("challenge_pp"),
            "challengeCategories" => Config::get("challenge_group"),
            "minBudget" => Config::get("min_coast_budget"),
            "maxBudget" => Config::get("max_coast_budget"),
            "challenge" => $challenge
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Inertia\Response
     */
    public function update(CreateChallengeRequest $request, Challenge $challenge)
    {
        if (! $challenge->mine){
            exit(403);
        }

        if (! $challenge->status != 'draft'){
            return redirect(\route("challenge.index"));
        }

        $challenge->title = $request->get('title');
        $challenge->description = $request->get('description');
        $challenge->started_at = $request->get('startDate');
        $challenge->expiration_at = $request->get("endDate");
        $challenge->type = $request->get('isCost') ? "nonfree": "free";
        $challenge->budget = $request->get('budget');
        $challenge->category = $request->get('category');

        if ($request->get('isCost')){
            $challenge->cost = $request->get('costPrice');
        }

        if ($request->hasFile('picture')){
            if ($challenge->picture){
                Storage::delete($challenge->picture);
            }
            $challenge->picture = $request->file("picture")->store("challenge/picture");
        }

        if ($request->hasFile('document')){
            if ($challenge->docuement){
                Storage::delete($challenge->document);
            }
            $challenge->picture = $request->file("document")->store("challenge/picture");
        }

        if ($challenge->save()){
            return redirect(route("challenge.edit" , [$challenge->id]));
        }else{
            throw \Illuminate\Validation\ValidationException::withMessages([
                "unknown" => "خطایی در ذخیره اطلاعات رخ داده است."
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pay(Challenge $challenge)
    {
        if (! $challenge->mine){
            throw \Illuminate\Validation\ValidationException::withMessages([
                "unknown" => "این چالش متعلق به شما نیست."
            ]);
        }

        $tax = ($challenge->budget - Config::get('min_coast_budget')) /  Config::get('max_coast_budget') *  Config::get('max_tax_challenge') + Config::get('min_tax_challenge');
        $price = floor($challenge->budget + $tax) * 10;
        $challenge->status = "pending";
        $challenge->save();
        $payinfo = IdPayPayment::create($price , [
           "for" => Challenge::class,
           "id" => $challenge->id
        ]);

        if ($payinfo){
            return redirect($payinfo->link);
        }else{
            throw \Illuminate\Validation\ValidationException::withMessages([
                "unknown" => "خطای درگاه پرداخت"
            ]);
        }

    }

    public function challenges(Request $request){
        return Inertia::render("Web/myChallenge" , [
            "chs" => (new Challenge())->parseQueries($request)->whereNull("ended_at")->where("status" , 'paid')->paginate(5),
            "myTitle" => "چالش ها"
        ]);
    }
}
