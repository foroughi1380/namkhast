<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Models\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class WithdrawRequestController extends Controller
{
    public function index(){
        $isAuth = AuthRequest::query()->where('user_id' , Auth::user()->id)->first();

        return Inertia::render("Web/withdraw" , [
            'isAuth' => $isAuth->status
        ]);
    }

    public function submitRequest(WithdrawRequest $request){
        //TODO: Check User Have Enough Balance To Withdraw Later

        if(DB::table('withdraw_request')->insert(['user_id'=>$request->user()->id,'price'=>$request->get('price')])) {
            return redirect('/withdraw/track');
        }else{
            return Inertia::render("Web/withdraw" , [
                'errors' => ['term' => 'متاسفانه خطایی در سامانه رخ داده است.']
            ]);
        }
    }

    public function track(){
        return Inertia::render("Web/withdrawTrack");
    }
}
