<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcLoginRequest;
use App\Models\Admin;
use App\Models\User;
use App\Utilities\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render("AC/Users" , [
            'users' => $users
        ]);
    }

    public function edit($id){
        $user = User::query()->find($id);
        return Inertia::render("AC/userEdit" , [
            'user' => $user
        ]);
    }

    public function update($id , Request $request){
        $request->validate([
            'name' => 'min:3|max:30|string',
            'family'=> 'min:2|max:35|string',
            "phone" => "digits:11|regex:/^09\d{9}$/|unique:admin,phone,". $id,
            "iban" => "regex:/^(?=.{24}$)[0-9]*$/",
            "token" => "required|captcha:editUser"
        ]);

        $user = User::query()->find($id);
        $user->update($request->all());

        return Inertia::render('AC/Users');
    }

    public function destroy($id){
        User::destroy($id);
        return redirect('/ac/user');
    }

    public function changeStatus($id){

    }

    function loginIndex()
    {
        return Inertia::render("AC/login");
    }

    function login(AcLoginRequest $request)
    {
        // check request token validation
        if (!Utilities::checkRecaptcha($request->get('token'), 'login', $request->ip())) {
            return Inertia::render("AC/login", [
                'errors' => ['token' => 'کپچا نامعتبر است !']
            ]);
        }

        $adminUser = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($adminUser)) {
            $adminUserInstance = Admin::query()->where('email' ,'=', $request->get('email'))->first();
            Auth::guard('admin')->loginUsingId($adminUserInstance->id);

            return Inertia::render("AC/login");
        }

        return Inertia::render("AC/login",[
            'errors' => ['email' => 'کلمه عبور یا ایمیل اشتباه است']
        ]);
    }
}
