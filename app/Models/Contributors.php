<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributors extends Model
{
    use HasFactory;

    protected $table = 'contributors';

    protected $fillable = ["challenge_id" , "user_id" , "transaction_id" ,"suggested_name" , "sound" , "description"];

    public function getSoundAttribute($value)
    {
        if (! $value) return $value;
        return env("AWS_PUBLIC_DOWNLOAD_PREFIX") . $value;
    }
}
