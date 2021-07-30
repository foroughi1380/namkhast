<?php

namespace App\Providers;

use App\Models\Config;
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
        Validator::extend('captcha', function ($attribute, $value, $parameters) {
            if (! Config::get("check_captcha" , false)) return true;
            $action = isset($parameters[0]) ? $parameters[0] : 'form';
            return Utilities::checkRecaptcha($value, $action, Request::ip());
        }, "شما به عنوان ربات شناخته شدید.");
        Validator::extend("nationalCode", function ($attr, $code, $parameters) {
            if (!preg_match('/^[0-9]{10}$/', $code))
                return false;
            for ($i = 0; $i < 10; $i++)
                if (preg_match('/^' . $i . '{10}$/', $code))
                    return false;
            for ($i = 0, $sum = 0; $i < 9; $i++)
                $sum += ((10 - $i) * intval(substr($code, $i, 1)));
            $ret = $sum % 11;
            $parity = intval(substr($code, 9, 1));
            if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
                return true;
            return false;
        } , "کد ملی وارد شده صحیح نمیباشد.");
    }
}
