<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\SendSms;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;


class ReLoController extends Controller
{
    function loginIndex(){
        //SendSms::sendConfirmCode("09162943094");
        Inertia::setRootView("userRegisterLogin");
        return Inertia::render("Web/login");
    }

    function login(LoginRequest $request){
        return Inertia::render("Web/login" , [
           '' => "all thing is ok"
        ]);
    }
}
