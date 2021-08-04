<?php

namespace App\Models;

use App\QueryHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory , QueryHelper;
    protected $fillable =[
        'user_id' , 'challenge_id'
    ];
}
