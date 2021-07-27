<?php

use App\Http\Controllers\web\IndexController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post("update" , [\App\Http\Controllers\web\UserController::class, "update"]);
Route::get('/', [IndexController::class , "index"]);
Route::middleware([\App\Http\Middleware\webNoAuthMiddleware::class])->group(function (){
    Route::get("/login" , [\App\Http\Controllers\web\ReLoController::class , "loginIndex"])->name("login");
    Route::post("/login" , [\App\Http\Controllers\web\ReLoController::class , "login"]);

    Route::get("/register" , [\App\Http\Controllers\web\ReLoController::class , "registerIndex"])->name("register");
    Route::post("/register" , [\App\Http\Controllers\web\ReLoController::class , "register"]);
});

Route::middleware(["auth"])->group(function (){
    Route::get("/logout" , function (){\Illuminate\Support\Facades\Auth::logout(); return \Illuminate\Support\Facades\Redirect::to("/");})->name("logout");
});


Route::get('/profile', function (){
    return \Inertia\Inertia::render('Web/profile');
});
Route::get('/challenge', function (){
    return \Inertia\Inertia::render('Web/challenges');
});
Route::get('/participants', function (){
    return \Inertia\Inertia::render('Web/participants');
});
Route::get('/favorites', function (){
    return \Inertia\Inertia::render('Web/favorites');
});
Route::get('/about', function (){
    return \Inertia\Inertia::render('Web/about');
});
Route::inertia('/challenge/create', 'Web/challengeCreate');
Route::inertia('/challenge/myChallenge', 'Web/myChallenge');
Route::inertia('/profile/edit', 'Web/profileEdit');
Route::inertia('/withdraw', 'Web/withdraw');
Route::inertia('/withdraw/track', 'Web/withdrawTrack');
Route::inertia('/challenge/detail', 'Web/challengeDetail');
Route::inertia('/challenge/participants', 'Web/challengeParticipants');
Route::inertia('/challenge/suggestDetail', 'Web/suggestDetail');

