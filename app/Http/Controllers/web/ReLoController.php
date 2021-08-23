<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
        Inertia::setRootView("userRegisterLogin");
        return Inertia::render("Web/login");
    }
    function registerIndex(){
        Inertia::setRootView("userRegisterLogin");
        return Inertia::render("Web/register");
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
        if ($user->status != 'active'){
            return Inertia::render("Web/login" , [
                'errors' => ['phone'=>'حساب کاربری شما غیر فعال است.']
            ]);
        }

        if (!$request->has("code")){
            $user->cc = bcrypt(SendSms::sendConfirmCode($user->phone));
//            $user->cc = bcrypt(1234);
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

    public function register(RegisterRequest $request)
    {
        if (! Utilities::checkRecaptcha($request->get('token') , 'register' , $request->ip)){
            return Inertia::render("Web/register" , [
               'errors' => ['term' => 'شما به عنوان ربات شناخته شدید.']
            ]);
        }

        if (User::create($request->only(['name' , 'family' , 'phone']))){
            return Inertia::render("Web/login" , ["ph"=>$request->get("phone") ,
                                                            "toasts"=>[
                                                                    ['message'=>'شما با موفقیت ثبت نام کردید' ,
                                                                    'type'=>'success']
                                                                    ]
                                                            ]);
        }else{
            return Inertia::render("Web/register" , [
                'errors' => ['term' => 'متاسفانه خطایی در سامانه رخ داده است.']
            ]);
        }
    }
}
