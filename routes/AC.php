<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/" , [\App\Http\Controllers\AC\MainController::class , 'index']);

Route::resource('users' , "UserController")->only(['index']);