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
        return AuthRequest::query()->find($this->id);
    }

    public function getPictureName()
    {
        return $this->getRawOriginal("picture");
    }

    public function getPictureAttribute($value)
    {
        return env("AWS_PUBLIC_DOWNLOAD_PREFIX") . $value;
    }


}
