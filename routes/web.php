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

Route::get('/', [IndexController::class , "index"]);
Route::middleware([\App\Http\Middleware\webNoAuthMiddleware::class])->group(function (){
    Route::get("/login" , [\App\Http\Controllers\web\ReLoController::class , "loginIndex"]);
    Route::post("/login" , [\App\Http\Controllers\web\ReLoController::class , "login"]);

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

