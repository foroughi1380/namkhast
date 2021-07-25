<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:30|string',
            'family'=> 'required|min:2|max:35|string',
            "phone" => "required|digits:11|regex:/^09\d{9}$/|unique:user,phone",
            "token" => "require"
        ];
    }

    public function messages()
    {
        return [
            'name.*' => 'نام باید بین ۳ تا ۳۰ کاراکتر باشد',
            'family.*' => 'نام خانوادگی باید بین ۲ تا ۳۵ کاراکتر باشد' ,
            'phone.unique' => 'شماره تلفن وارد شده قبلا در سامانه ثبت نام کرده است',
            'phone.*' => "شماره تلفن خود را صحیح وارد کنید مثل : 09123949383",
            'token.*' => 'جواب کپچا به نادرست است'
        ];
    }
}
