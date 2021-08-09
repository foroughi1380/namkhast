<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateProfileRequest;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return \Inertia\Inertia::render('Web/profile' , [
            'specificUser' => Auth::user(),
            'winnerCount'=> Challenge::query()->where("winner_user" , Auth::id())->count(),
            'challengeCount' => Challenge::query()->where("user_id" , Auth::id())->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Inertia\Response
     */
    public function show(User $user)
    {
        return \Inertia\Inertia::render('Web/profile' , [
            'specificUser' => $user,
            'winnerCount'=> Challenge::query()->where("winner_user" , $user->id)->count(),
            'challengeCount' => Challenge::query()->where("user_id" , $user->id)->count()
        ]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $id
     * @return \Inertia\Response
     */
    public function edit(User $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function update(UserUpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->name = $request->get("name" , $user->name);
        $user->family = $request->get("family" , $user->family);
        $user->phone = $request->get("phone" , $user->phone);
        $user->iban = $request->get("iban" , $user->iban);

        if ($request->hasFile("picture")){
            if ($user->picture != null){
                Storage::delete($user->getPictureName());
            }
            $user->picture = $request->file("picture")->store("avatars");
        }

        if ($user->update()){
            return Inertia::render("Web/profileEdit");
        }else{
            throw ValidationException::withMessages([
               "unknown" => "خطای نامشخصی در سرور رخ داده است."
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
