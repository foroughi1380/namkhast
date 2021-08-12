<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Models\AuthRequest;
use App\Models\Challenge;
use App\Models\User;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MainController extends Controller
{
    function index()
    {
        $userQuery = DB::select("select dc.date , dc.count + n.new as count , n.new from (select date(ob1.created_at) as date , count(ob2.id) as count from user as ob1 left join user as ob2 on date(ob1.created_at) > date(ob2.created_at) GROUP BY date ) as dc inner join (SELECT date(user.created_at) as date , COUNT(user.id) as new from user GROUP BY date ) as n on dc.date = n.date");

        $challengeQuery = DB::select("select dc.date , dc.count + n.new as count , n.new from (select date(ob1.created_at) as date , count(ob2.id) as count from challenge as ob1 left join challenge as ob2 on date(ob1.created_at) > date(ob2.created_at) GROUP BY date ) as dc inner join (SELECT date(challenge.created_at) as date , COUNT(challenge.id) as new from challenge GROUP BY date ) as n on dc.date = n.date ");

        $userChart = [
            "total" => array_map(fn($v) => $v->count, $userQuery),
            'date' => array_map(fn($v) => $v->date, $userQuery),
            'new' => array_map(fn($v) => $v->new, $userQuery),
        ];

        $challengeChart = [
            "total" => array_map(fn($v) => $v->count, $challengeQuery),
            'date' => array_map(fn($v) => $v->date, $challengeQuery),
            'new' => array_map(fn($v) => $v->new, $challengeQuery),
        ];
        return Inertia::render("AC/dashboard", [
            'userCount' => User::query()->count(),
            'todayUserCount' => User::query()->whereDate('created_at', '=', today())->count(),
            'challengeCount' => Challenge::query()->count(),
            'todayChallengeCount' => Challenge::query()->whereDate('created_at', '=', today())->count(),
            'authReqCount' => AuthRequest::query()->where('status', 'pending')->count(),
            'widReqCount' => WithdrawRequest::query()->where('status', 'pending')->count(),
            'challengeChart' => $challengeChart,
            'userChart' => $userChart,
        ]);
    }
}
