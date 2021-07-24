<?php

use App\Http\Controllers\web\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::get('/profile', function (){
    return \Inertia\Inertia::render('Web/profile');
});
Route::get('/challenge', function (){
    return \Inertia\Inertia::render('Web/challenges');
});
Route::get('/participants', function (){
    return \Inertia\Inertia::render('Web/participants');
});
