<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoriteController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render("Web/myChallenge" , [
            "chs" => (new Challenge())->parseQueries($request)->join('favorites' , function (JoinClause $join){
                $join->on('favorites.challenge_id' , "=" , 'challenge.id');
                $join->where('favorites.user_id' , '=' , Auth::id());
            })->paginate(5),
            "myTitle" => "علاقه مندی ها"
        ]);
    }
    public function update(Challenge $favorite)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($favorite->is_favorite){
            $user->getFavoriteChallenges()->detach($favorite);
        }else{
            $user->getFavoriteChallenges()->attach($favorite);
        }
    }
}
