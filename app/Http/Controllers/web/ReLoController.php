<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Utilities\SendSms;
use App\Utilities\Utilities;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class ReLoController extends Controller
{
    function loginIndex(){
        //SendSms::sendConfirmCode("09162943094");
        Inertia::setRootView("userRegisterLogin");
        return Inertia::render("Web/login");
    }

    function login(LoginRequest $request){
        // check request token validation
        if (! Utilities::checkRecaptcha($request->get('token') , 'login' , $request->ip())){
            return Inertia::render("Web/login" , [
                'errors' => ['token'=>'کپچای شما رد شد بهتر است صفجه را مجددا بارگذاری کنید.']
            ]);
        }

        /** @var User $user */
        $user = User::query()->where('phone' , '=' , $request->get("phone"))->first();
        if (!$request->has("code")){
            //$user->cc = bcrypt(SendSms::sendConfirmCode($user->phone));
            $user->cc = bcrypt(1234);
            $user->save();

            return Inertia::render("Web/login" , [
               'conf' => true
            ]);
        }else{
            if (Hash::check($request->get("code") , $user->cc)){
                $user->cc = "";
                $user->save();
                Auth::login($user);
                return Inertia::render("Web/login" , ['refresh'=>true]);
            }

            return Inertia::render("Web/login" , [
                'errors' => ["code"=>"کد وارد شده صحیح نمیباشد"]
            ]);
        }
    }
}
