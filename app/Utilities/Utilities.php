<?php


namespace App\Utilities;


use ReCaptcha\ReCaptcha;

class Utilities
{
    static function checkRecaptcha($token , $action , $ip){
        $recaptcha = new ReCaptcha(env("MIX_RECAPTCHA3_SECRET"));
        $recaptcha->setExpectedAction($action);
        $recaptcha->setExpectedHostname(env("APP_HOSTNAME"));
        $recaptcha->setScoreThreshold(0.6);
        $res = $recaptcha->verify($token , $ip);
        return $res->isSuccess();
    }
}