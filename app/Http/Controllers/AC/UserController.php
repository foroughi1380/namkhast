<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcLoginRequest;
use App\Models\Admin;
use App\Utilities\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    function index()
    {
        return Inertia::render("AC/Users");
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
            Auth::guard('admin')->login($adminUserInstance);

            return Inertia::render("AC/dashboard");
        }

        return Inertia::render("AC/login",[
            'errors' => ['email' => 'کلمه عبور یا ایمیل اشتباه است']
        ]);
    }
}
