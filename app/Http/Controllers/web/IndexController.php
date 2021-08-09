<?php

namespace App\Http\Controllers\web;



use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\User;
use App\Models\Wallet;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index(){
        return Inertia::render('Web/index',[
            "userCount" => User::query()->count(),
            "challengeCount" => Challenge::query()->count(),
            "payments" => Wallet::query()->sum("price"),
            "challenges" => Challenge::query()->where("status" , 'paid')->whereNull('ended_at')->limit(5)->get()
        ]);
    }
}
