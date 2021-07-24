<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReLoController extends Controller
{
    function loginIndex(){
        Inertia::setRootView("userRegisterLogin");
        return Inertia::render("Web/login");
    }
}
