<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Challenge extends Model
{
    use HasFactory;

    protected $table="challenge";

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'transaction_id',
        'winner_id',
        'status',
        'ended_at',
        'budget',
        'type',
        'contributors_count',
        'document',
        'started_at',
        'category',
        'picture',
        'cost'
    ];

    protected $appends =[
        'mine'
    ];
    public function getMineAttribute()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user){
            return $this->user_id === $user->id;
        }
        return false;
    }

    public function getPictureAttribute($value)
    {
        if ($value){
            return env("AWS_PUBLIC_DOWNLOAD_PREFIX") . $value;
        }
        return $value;
    }

    public function getDocumentAttribute($value)
    {
        if ($value){
            return env("AWS_PUBLIC_DOWNLOAD_PREFIX") . $value;
        }else{
            return $value;
        }
    }
}