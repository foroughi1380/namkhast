<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateChallengeRequest;
use App\Models\Challenge;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Nette\Schema\ValidationException;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render("Web/myChallenges");
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
        return Inertia::render("Web/challengeDetail");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Challenge $challenge)
    {
        if (! $challenge.mine){
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
        if (! $challenge.mine){
            exit(403);
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
}
