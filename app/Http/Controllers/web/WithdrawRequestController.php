<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WithdrawRequest;
use App\Http\Requests\WithdrawRequest as wdRequest;
use App\Models\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class WithdrawRequestController extends Controller
{
    public function index(){
        $isAuth = AuthRequest::query()->where('user_id' , Auth::user()->id)->first();

        return Inertia::render("Web/withdraw" , [
            'isAuth' => $isAuth->status
        ]);
    }

    public function submitRequest(wdRequest $request){
        if (Wallet::query()->where("user_id" , Auth::id())->sum("price") < $request->get("price")){
            throw ValidationException::withMessages([
               "price" => "اعتبار حساب شما کافی نمیباشد."
            ]);
        }
        $wr = WithdrawRequest::create(['user_id'=>$request->user()->id,'price'=>$request->get('price')]);
        if($wr) {
            $wallet = new Wallet();
            $wallet->user_id = Auth::id();
            $wallet->price = $request->get("price") * -1;
            $wallet->extras = [
                "for" => WithdrawRequest::class,
                "id" => $wr->id
            ];
            $wallet->save();

            return redirect('/withdraw/track');
        }else{
            return Inertia::render("Web/withdraw" , [
                'errors' => ['term' => 'متاسفانه خطایی در سامانه رخ داده است.']
            ]);
        }
    }

    public function track(Request $request){
        $wdRequests = WithdrawRequest::query()->where('user_id' , $request->user()->id)->get();

        return Inertia::render("Web/withdrawTrack",[
            'wdRequests' => $wdRequests
        ]);
    }
}
