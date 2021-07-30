<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;

    protected $table = "withdraw_request";

    protected $fillable = [
        "id",
        "price",
        "status"
    ];

    protected $hidden = [
        "user_id"
    ];
}
