<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transaction";
    use HasFactory;
    protected $fillable = [
      'price' , 'tracking_code' , 'response_code' , 'status' , 'paid_at' , 'transaction_code' , 'extras'
    ];

    protected $casts = [
        'extras' => "array"
    ];
}
