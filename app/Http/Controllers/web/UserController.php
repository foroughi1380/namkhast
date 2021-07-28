<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateProfileRequest;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
