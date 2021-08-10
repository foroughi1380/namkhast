<?php

namespace App\Http\Controllers;

use App\Http\IdPayPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionCallBackController extends Controller
{
    public function store(Request $request)
    {
        $flag = true;
        $status = $request->get("status");
        $id = $request->get('order_id');
        $tracking_code = $request->get('track_id');
        $transaction_code = $request->get("id");

        $transaction = Transaction::query()->find($id);
        if (! $transaction || $transaction->transaction_code != $transaction_code || $transaction->status !== "payment") {
            return "تراکنش نامعتبر";
        }


        $transaction->status = "failed";
        $transaction->tracking_code = $tracking_code;
        $transaction->response_code = $status;
        $transaction->paid_at = now();

       if ($status == 10){
          if (IdPayPayment::checkValid($status , $transaction->price , $transaction_code , $tracking_code , $id)){
              if (IdPayPayment::submit($transaction_code , $id)){
                  $transaction->status = "paid";
              }else{
                  $flag = false;
              }
          }else{
              $flag = false;
          }
       }else{
           $flag = false;
       }

       if ($transaction->save()){

           if ($flag){
               return  "پرداخت با موفقت انجام شد";
           }else{
               return "پرداخت نا موفق";
           }

       }else{
           return "خطا در ثبت پرداخت";
       }
    }
}
