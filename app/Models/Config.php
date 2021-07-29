<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Config extends Model
{
    use HasFactory;
    protected $fillable = ["key" , "type" , "value"];

    protected function getCastType($key)
    {
        if ($key === 'value'){
            return $this->type;
        }else{
            return parent::getCastType($key);
        }
    }

    public static function get($key){
        $conf = Config::query()->where("key" , $key)->first();
        if ($conf){
            return $conf->value;
        }
        return null;
    }

    public static function set($key , $value){
        $conf = Config::query()->where("key" , $key)->first();
        if ($conf){
            $conf->value = $value;
            return $conf->save();
        }
        return false;
    }
}
