<?php

namespace App\Http\Requests;

use App\Models\Config;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateChallengeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|string|max:255|min:5",
            "description" => "required|string|max:5000|min:20",
            "startDate" => 'nullable|date|after_or_equal:today',
            "endDate" => 'nullable|date|after_or_equal:startDate',
            "picture" => 'file|image|max:1000',
            'document' => 'file|max:20000',
            'isCost' => 'required|boolean',
            'costPrice' => [Rule::requiredIf($this->get('isCoast' , false)),'numeric' ,'in:' .implode("," , Config::get('challenge_pp'))],
            'budget' => "required|numeric|min:".Config::get('min_coast_budget')."|max:".Config::get('max_coast_budget'),
            'category' => "required|in:".implode("," , Config::get('challenge_group'))
        ];
    }

    public function messages()
    {
        return [
            "title.*" => "موضوع باید حدقال ۵ و حداکثر ۲۵۵ کاراکتر باشد.",
            "description.*" => "توضیحات باید حدقال ۲۰ و حداکثر ۵۰۰۰ کاراکتر باشد.",
            "startDate.*"=>"تاریخ شروع نباید قبل از تاریخ امروز باشد.",
            "endDate.*"=>"تاریخ پایان نباید قبل از تاریخ شروع باشد.",
            "picture.*" => "حداکثر سایز مجاز ۱ مگ میباشد.",
            "document.*" => "حداکثر سایز مجاز ۲۰ مگ میباشد.",
            "isCoast.*" => "مقدار ورودی صحیح نمیباشد." ,
            "costPrice.*" => "لطفا یکی از مقادیر را انتخاب کنید.",
            "budget.*" => "رعایت نشدن مقدار صحیح.",
            "category.*" => "لطفا دسته بندی خود را انتخاب کنید."
        ];
    }
}
