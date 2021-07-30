<?php

namespace App\Http\Controllers\AC;

use App\Models\User;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class WithdrawRequestController extends Controller
{
    public function index()
    {
        $wdRequests = WithdrawRequest::all()->makeVisible(['user_id']);

        return Inertia::render("AC/withdrawRequest" , [
            'wdRequests' => $wdRequests
        ]);
    }

    public function changeStatus($id)
    {
        $wdRequest = WithdrawRequest::query()->find($id);
        $wdRequest->status =  $wdRequest->status == 'pending'? 'payed' : 'pending';
        $wdRequest->save();

        return redirect('/ac/withdraw-request');
    }

    public function show($id){
        $wdRequest = WithdrawRequest::query()->find($id);
        $user = User::query()->find($wdRequest->user_id);

        return Inertia::render("AC/withdrawRequestDetail" , [
            'wdRequest' => $wdRequest,
            'user' => $user
        ]);
    }
}
