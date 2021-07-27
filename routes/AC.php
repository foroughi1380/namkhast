<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::resource('users' , "UserController")->only(['index']);

Route::middleware([\App\Http\Middleware\webNoAuthMiddleware::class])->group(function (){
    Route::get("/login" , [\App\Http\Controllers\AC\UserController::class , "loginIndex"]);
    Route::post("/login" , [\App\Http\Controllers\AC\UserController::class , "login"]);
});

Route::middleware(["auth"])->group(function (){
    Route::get("/" , [\App\Http\Controllers\AC\MainController::class , 'index']);
    Route::get("/logout" , function (){\Illuminate\Support\Facades\Auth::logout(); return \Illuminate\Support\Facades\Redirect::to("/");})->name("logout");
});