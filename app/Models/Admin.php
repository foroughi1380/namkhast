<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'id' , 'name' , 'family' , 'phone' , 'email' , 'picture'
    ];

    protected $hidden = [
      'password'
    ];
}
