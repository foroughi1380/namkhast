<?php
namespace App\Http;

use Melipayamak\MelipayamakApi;
use SoapClient;

class SendSms
{
    static function sendConfirmCode($to): bool
    {
        $username = env("SMS_MELIPAYAMAK_USERNAME");
        $password = env("SMS_MELIPAYAMAK_PASSWORD");
        $bodyId = env("SMS_MELIPAYAMAK_CONFIRM_CODE_PATTERN_ID");

        $code = rand(1000, 9999);

        ini_set("soap.wsdl_cache_enabled","0");
        $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
        $data = array(
            "username"=>$username,
            "password"=>$password,
            "text"=>array($code),
            "to"=>$to,
            "bodyId"=>$bodyId);
        $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;
        if ($send_Result > 15){
            return $code;
        }
        return false;
    }
}