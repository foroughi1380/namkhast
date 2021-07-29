<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthRequest extends Model
{
    use HasFactory;
    protected $table = "authentication_request";
//    protected $primaryKey = "user_id";

    protected $fillable = [
        "id",
      "status",
      "national_code",
      "description"
    ];

    protected $hidden = [
        "try",
        "nc_picture",
        "user_id"
    ];

    public function getStatusAttribute($value){
        if ($value === 'block' && Carbon::createFromTimestamp($this->getUpdatedAtColumn())->addDays(3)->isBefore(now())){
            return "unblock";
        }
        return $value;
    }

    public function getNationalCodePicture()
    {
        return Storage::get($this->picture);
    }
}
