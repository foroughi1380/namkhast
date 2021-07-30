<?php

namespace App\Http\Controllers\AC;

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

    }
}
