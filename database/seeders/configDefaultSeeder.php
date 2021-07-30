<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class configDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Config::create(['name'=>'برسی کپچا های ورودی' , 'key' => 'check_captcha' , 'type'=>'boolean' , 'value' => "1"]);
        Config::create(['name'=>'حق سایت در ساخت چالش رایگان' , 'key' => 'challenge_fpf' , 'type'=>'float' , 'value' => "0.05"]);
        Config::create(['name'=>'حق سایت در ساخت چالش پولی' , 'key' => 'challenge_ppf' , 'type'=>'float' , 'value' => "0.01"]);
        Config::create(['name'=>'دسته بندی های چالش ها' , 'key' => 'challenge_group' , 'type'=>'array' , 'value' => ["دسته اول","دسته دوم","دسته سوم"]]);
        Config::create(['name'=>'نرخ های شرکت در چالش پولی' , 'key' => 'challenge_pp' , 'type'=>'array' , 'value' => ["1000","2000","3000","4000","5000"]]);
    }
}
