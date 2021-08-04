<?php


namespace App\Http;


use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class IdPayPayment
{
    public static function create($amount , $extras){
        $transaction = new Transaction();
        $transaction->status = "payment";
        $transaction->price = $amount;
        $transaction->extras = $extras;
        $transaction->save();

        $params = array(
            'order_id' => $transaction->id,
            'amount' => $amount,
            'callback' => 'https://polite-lizard-53.loca.lt/transactioncallback',
//            'callback' => route("callback"),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params , JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: '.env('IdPay_Key' , 1),
            'X-SANDBOX: '.env('IdPay_SandBox' , 1)
        ));

        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch , CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($status_code == 201){
            $ret = json_decode($result);
            $transaction->transaction_code = $ret->id;
            $transaction->save();
            return  $ret;
        }
        return false;
    }
    public static function checkValid($status , $amount , $id , $track_id , $order_id)
    {
        $params = array(
            'id' => $id,
            'order_id' => $order_id,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/inquiry');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: '.env('IdPay_Key' , 1),
            'X-SANDBOX: '.env('IdPay_SandBox' , 1)
        ));

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode === 200){
            $result = json_decode($result);
            $flag = true;
            $flag &= $result->status == 10;
            $flag &= $status == 10;
            $flag &= $result->amount == $amount;
            $flag &= $result->track_id == $track_id;
            $flag &= $result->id == $id;

            return $flag;
        }

        return false;
    }
    public static function submit($id , $order_id){
        $params = array(
            'id' => $id,
            'order_id' => $order_id,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: '.env('IdPay_Key' , 1),
            'X-SANDBOX: '.env('IdPay_SandBox' , 1)
        ));

        $response = json_decode(curl_exec($ch));
        $httpcode = curl_getinfo($ch , CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode === 200 && $response->status === 100;
    }
}