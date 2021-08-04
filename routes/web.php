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

Route::get("pay" , [\App\Http\Controllers\TransactionCallBackController::class , "pay"]);
Route::post("transactioncallback" , [\App\Http\Controllers\TransactionCallBackController::class , "store"])->name("callback");

Route::get('/', [IndexController::class , "index"]);
Route::middleware([\App\Http\Middleware\webNoAuthMiddleware::class])->group(function (){
    Route::get("/login" , [\App\Http\Controllers\web\ReLoController::class , "loginIndex"])->name("login");
    Route::post("/login" , [\App\Http\Controllers\web\ReLoController::class , "login"]);

    Route::get("/register" , [\App\Http\Controllers\web\ReLoController::class , "registerIndex"])->name("register");
    Route::post("/register" , [\App\Http\Controllers\web\ReLoController::class , "register"]);
});

Route::middleware(["auth"])->group(function (){
    Route::get("/logout" , function (){\Illuminate\Support\Facades\Auth::logout(); return \Illuminate\Support\Facades\Redirect::to("/");})->name("logout");

    Route::inertia('/profile/edit', 'Web/profileEdit');
    Route::post("/profile/edit" , [\App\Http\Controllers\web\UserController::class , "update"])->name("profile.update");
    Route::post("/profile/edit/auth" , [\App\Http\Controllers\web\AuthRequestController::class , "store"])->name("profile.auth");
    // Challenge
    Route::resource("/challenge" , \App\Http\Controllers\web\ChallengeController::class)->names("challenge");
    Route::get("/challenge/pay/{challenge}" , [\App\Http\Controllers\web\ChallengeController::class , 'pay'])->name("challenge.pay");
    Route::get("/challenge/suggest/{id}" , [\App\Http\Controllers\web\ChallengeController::class , "suggestDetail"] )->where('id', '[0-9]+')->name('challenge.suggest');
    Route::post("/challenge/choice-winner/{id}" , [\App\Http\Controllers\web\ChallengeController::class , "choiceWinner"] )->where('id', '[0-9]+')->name('challenge.winner');
    //Withdraw Requests
    Route::get("/withdraw" , [\App\Http\Controllers\web\WithdrawRequestController::class , "index"])->name("withdraw.index");
    Route::post("/withdraw/submit-request" , [\App\Http\Controllers\web\WithdrawRequestController::class , "submitRequest"])->name("withdraw.submitReq");
    Route::get("/withdraw/track" , [\App\Http\Controllers\web\WithdrawRequestController::class , "track"])->name("withdraw.track");

    Route::resource("/favorites" , \App\Http\Controllers\web\FavoriteController::class)->names( "favorite")->only(['index' , 'update']);

    Route::resource('/profile' , \App\Http\Controllers\web\UserController::class)->names('user')->only(['index' , 'edit']);

    Route::get('/challenges' , [\App\Http\Controllers\web\ChallengeController::class , 'challenges'])->name("challenges");
    Route::get('contributor/{challenge}' , [\App\Http\Controllers\web\ChallengeController::class , "contributor"])->name("contributor");
    Route::get('contributors' , [\App\Http\Controllers\web\ChallengeController::class , "contributorChallenges"])->name("contributors");
    Route::post('contributor/{cont}' , [\App\Http\Controllers\web\ChallengeController::class , "contributorUpdate"])->name("contributor.update" );
});


Route::get('/profile', function (){
    return \Inertia\Inertia::render('Web/profile');
});

Route::get('/participants', function (){
    return \Inertia\Inertia::render('Web/participants');
});
//Route::get('/favorites', function (){
//    return \Inertia\Inertia::render('Web/favorites');
//});
Route::get('/about', function (){
    return \Inertia\Inertia::render('Web/about');
});
//Route::inertia('/challenge/myChallenge', 'Web/myChallenge');
//Route::inertia('/challenge/detail', '');
Route::inertia('/challengee/participants', 'Web/challengeParticipants');
Route::inertia('/challengee/suggestDetail', 'Web/suggestDetail');

