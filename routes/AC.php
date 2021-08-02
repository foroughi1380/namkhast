<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([\App\Http\Middleware\webNoAuthMiddleware::class])->group(function (){
    Route::get("/login" , [\App\Http\Controllers\AC\UserController::class , "loginIndex"])->name('login.index');
    Route::post("/login" , [\App\Http\Controllers\AC\UserController::class , "login"])->name('login');
});

Route::middleware(["auth:admin"])->group(function (){
    Route::get("/" , [\App\Http\Controllers\AC\MainController::class , 'index'])->name('dashboard');
    Route::get("/logout" , function (){\Illuminate\Support\Facades\Auth::guard("admin")->logout(); return \Illuminate\Support\Facades\Redirect::to("/");})->name('logout');
    // admin actions
    Route::get('/admin' , [\App\Http\Controllers\AC\AdminController::class , "index"])->name('admin.index');
    Route::get('/admin/create' , [\App\Http\Controllers\AC\AdminController::class , "create"])->name('admin.create');
    Route::post('/admin/store' ,[\App\Http\Controllers\AC\AdminController::class , "store"])->name('admin.store');
    Route::delete('/admin/delete/{id}', [\App\Http\Controllers\AC\AdminController::class , "destroy"])->where('id', '[0-9]+')->name('admin.delete');
    Route::get('/admin/edit/{id}' , [\App\Http\Controllers\AC\AdminController::class , "edit"])->where('id', '[0-9]+')->name('admin.edit');
    Route::put('/admin/update/{id}', [\App\Http\Controllers\AC\AdminController::class , "update"])->where('id', '[0-9]+')->name('admin.update');
    // user actions
    Route::get('/user' , [\App\Http\Controllers\AC\UserController::class , "index"])->name('user.index');
    Route::get('/user/edit/{id}' , [\App\Http\Controllers\AC\UserController::class , "edit"])->where('id', '[0-9]+')->name('user.edit');
    Route::put('/user/update/{id}', [\App\Http\Controllers\AC\UserController::class , "update"])->where('id', '[0-9]+')->name('user.update');
    Route::delete('/user/delete/{id}', [\App\Http\Controllers\AC\UserController::class , "destroy"])->where('id', '[0-9]+')->name('user.delete');
    Route::post('/user/change-status/{id}', [\App\Http\Controllers\AC\UserController::class , "changeStatus"])->where('id', '[0-9]+')->name('user.changeStatus');
    // Auth Request
    Route::get('/auth-request' , [\App\Http\Controllers\AC\AuthRequestController::class , "index"])->name('authRequest.index');
    Route::get('/auth-request/edit/{id}', [\App\Http\Controllers\AC\AuthRequestController::class , "edit"])->where('id', '[0-9]+')->name('authRequest.edit');
    Route::put('/auth-request/update/{id}', [\App\Http\Controllers\AC\AuthRequestController::class , "update"])->where('id', '[0-9]+')->name('authRequest.update');

    //configs
    Route::resource('/config' , ConfigController::class)->names("config")->only(['index' , 'store']);
    Route::post('/config/add' , [\App\Http\Controllers\AC\ConfigController::class , "create"])->name("config.add");

    // Withdraw Request
    Route::get('/withdraw-request' , [\App\Http\Controllers\AC\WithdrawRequestController::class , "index"])->name('wdRequest.index');
    Route::get('/withdraw-request/show/{id}' , [\App\Http\Controllers\AC\WithdrawRequestController::class , "show"])->where('id', '[0-9]+')->name('wdRequest.show');
    Route::post('/withdraw-request/change-status/{id}', [\App\Http\Controllers\AC\WithdrawRequestController::class , "changeStatus"])->where('id', '[0-9]+')->name('wdRequest.changeStatus');
});