<?php

namespace App\Providers;

use App\Models\User;
use App\Utilities\Utilities;
use Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('captcha',function($attribute, $value, $parameters){
            $action = isset($parameters[0]) ? $parameters[0] : 'form';
            return Utilities::checkRecaptcha($value , $action , Request::ip());
        } , "شما به عنوان ربات شناخته شدید.");
    }
}
