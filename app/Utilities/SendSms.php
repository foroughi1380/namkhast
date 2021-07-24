<?php
namespace App\Utilities;

use Melipayamak\MelipayamakApi;

function sendConfirmCode($to) : bool{
    $username = env("SMS_MELIPAYAMAK_USERNAME");
    $password = env("SMS_MELIPAYAMAK_PASSWORD");
    $bodyId = env("SMS_MELIPAYAMAK_CONFIRM_CODE_PATTERN_ID");
    $code = rand(1000 , 9999);

    $api = new MelipayamakApi($username,$password);
    $smsRest = $api->sms();
    $res = $smsRest->sendByBaseNumber([$code], $to, $bodyId);
    dd($res);
}