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
        Config::create(['name'=>'برسی کپچا های ورودی'           , 'key' => 'check_captcha'      ,   'type'=>'boolean'   , 'value' => "1"]);
        Config::create(['name'=>'دسته بندی های چالش ها'         , 'key' => 'challenge_group'    ,   'type'=>'array'     , 'value' => ["شرکت","پروژه","نرم افزار","اختراع","جا و مکان" , "تیم - گروه" , "خدمات" , "کتاب - مقالات" , "وبسایت" , "فیلم و -یدئو" , "اهنگ - صوت - پادکست" , "انسان - بچه" , "حیوانات" , "اشیاء" , "دیگر دسته بندی ها"]]);
        Config::create(['name'=>'نرخ های شرکت در چالش پولی'     , 'key' => 'challenge_pp'       ,   'type'=>'array'     , 'value' => ["1000","2000","3000","4000","5000"]]);
        Config::create(['name'=>'حداقل مبلغ جایزه در چالش ها'   , 'key' => 'min_coast_budget'   ,   'type'=>'float'     , 'value' => 5000]);
        Config::create(['name'=>'حداکثر مبلغ جایزه در چالش ها'  , 'key' => 'max_coast_budget'   ,   'type'=>'float'     , 'value' => 40000000]);
        Config::create(['name'=>'کمترین کارمزد ثبت'             , 'key' => 'min_tax_challenge'  ,   'type'=>'float'     , 'value' => 500]);
        Config::create(['name'=>'بیشترین کارمزد ثبت'            , 'key' => 'max_tax_challenge'  ,   'type'=>'float'     , 'value' => 1000000]);

    }
}
