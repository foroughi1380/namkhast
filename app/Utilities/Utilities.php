<?php


namespace App\Utilities;


use App\Models\Challenge;
use App\Models\Config;
use ReCaptcha\ReCaptcha;

class Utilities
{
    static function checkRecaptcha($token , $action , $ip){
        $recaptcha = new ReCaptcha(env("MIX_RECAPTCHA3_SECRET" , '6LflZrobAAAAAIB8tTyEmSN11JL7g5uBuP-EXsRS'));
        $recaptcha->setExpectedAction($action);
        $recaptcha->setExpectedHostname(env("APP_HOSTNAME"));
        $recaptcha->setScoreThreshold(0.6);
        $res = $recaptcha->verify($token , $ip);
        return $res->isSuccess();
    }
    /** @var Challenge $challenge */
    static function calculateChallengePrice($challenge){
        $tax = ($challenge->budget - Config::get('min_coast_budget')) /  Config::get('max_coast_budget') *  Config::get('max_tax_challenge') + Config::get('min_tax_challenge');
        if ($challenge->type === "nonfree"){
            $tax = max($tax . 2 , Config::get('min_tax_challenge'));
        }
        return floor($challenge->budget + $tax);
    }
}