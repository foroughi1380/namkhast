<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\IdPayPayment;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function charge($price)
    {
        $validation = Validator::make(['price' => $price] , [
            "price"=>"required|numeric|min:5000|max:1000000|regex:/^[1-9][0-9]+00/",
        ]);

        if ($validation->fails()){
            throw ValidationException::withMessages([
                'price' => 'مبلغ وارد شده صحیح نمیباشد.'
            ]);
        }

        $transaction = IdPayPayment::create($price , ['for' => Wallet::class , 'user_id'=>Auth::id() , 'price'=>$price]);

        if ($transaction){
            return Inertia::location($transaction->link);
        }else{
            throw ValidationException::withMessages([
                'price' => 'خطا در اتصال به درگاه پرداخت.'
            ]);
        }
    }
}
