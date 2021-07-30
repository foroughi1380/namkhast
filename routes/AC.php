<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([\App\Http\Middleware\webNoAuthMiddleware::class])->group(function (){
    Route::get("/login" , [\App\Http\Controllers\AC\UserController::class , "loginIndex"]);
    Route::post("/login" , [\App\Http\Controllers\AC\UserController::class , "login"]);
});

Route::middleware(["auth:admin"])->group(function (){
    Route::get("/" , [\App\Http\Controllers\AC\MainController::class , 'index']);
    Route::get("/logout" , function (){\Illuminate\Support\Facades\Auth::guard("admin")->logout(); return \Illuminate\Support\Facades\Redirect::to("/");});
    // admin actions
    Route::get('/admin' , [\App\Http\Controllers\AC\AdminController::class , "index"]);
    Route::get('/admin/create' , [\App\Http\Controllers\AC\AdminController::class , "create"]);
    Route::post('/admin/store' ,[\App\Http\Controllers\AC\AdminController::class , "store"]);
    Route::delete('/admin/delete/{id}', [\App\Http\Controllers\AC\AdminController::class , "destroy"])->where('id', '[0-9]+');
    Route::get('/admin/edit/{id}' , [\App\Http\Controllers\AC\AdminController::class , "edit"])->where('id', '[0-9]+');
    Route::put('/admin/update/{id}', [\App\Http\Controllers\AC\AdminController::class , "update"])->where('id', '[0-9]+');
    // user actions
    Route::get('/user' , [\App\Http\Controllers\AC\UserController::class , "index"]);
    Route::get('/user/edit/{id}' , [\App\Http\Controllers\AC\UserController::class , "edit"])->where('id', '[0-9]+');
    Route::put('/user/update/{id}', [\App\Http\Controllers\AC\UserController::class , "update"])->where('id', '[0-9]+');
    Route::delete('/user/delete/{id}', [\App\Http\Controllers\AC\UserController::class , "destroy"])->where('id', '[0-9]+');
    Route::post('/user/change-status/{id}', [\App\Http\Controllers\AC\UserController::class , "changeStatus"])->where('id', '[0-9]+');
    // Auth Request
    Route::get('/auth-request' , [\App\Http\Controllers\AC\AuthRequestController::class , "index"]);
    Route::get('/auth-request/edit/{id}', [\App\Http\Controllers\AC\AuthRequestController::class , "edit"])->where('id', '[0-9]+');
    Route::put('/auth-request/update/{id}', [\App\Http\Controllers\AC\AuthRequestController::class , "update"])->where('id', '[0-9]+');

    //configs
    Route::resource('/config' , ConfigController::class)->names("config")->only(['index' , 'store']);
    Route::post('/config/add' , [\App\Http\Controllers\AC\ConfigController::class , "create"])->name("config.add");
});