<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'family',
        'phone',
        'cc',
        'iban',
        'picture',
        'nc_picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'cc',
        'remember_token',
    ];

    protected $appends = [
      "auth"
    ];

    public function getAuthAttribute($value){
        return AuthRequest::query()->where("user_id" , $this->id)->first(["national_code" , "status" , "description"]);
    }

    public function getPictureName()
    {
        return $this->getRawOriginal("picture");
    }

    public function getPictureAttribute($value)
    {
        if (! $value) return $value;
        return env("AWS_PUBLIC_DOWNLOAD_PREFIX") . $value;
    }


}
