<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcAdminCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30|string',
            'family'=> 'required|min:2|max:35|string',
            "phone" => "required|digits:11|regex:/^09\d{9}$/|unique:admin,phone",
            "email" => "required|email|unique:admin,email",
            "password" => "required|min:6",
        ];
    }

    public function messages()
    {
        return [
            'name.*' => 'نام باید بین ۳ تا ۳۰ کاراکتر باشد',
            'family.*' => 'نام خانوادگی باید بین ۲ تا ۳۵ کاراکتر باشد' ,
            'phone.unique' => 'شماره تلفن وارد شده قبلا در سامانه ثبت نام کرده است',
            'phone.*' => "شماره تلفن خود را صحیح وارد کنید مثل : 09123949383",
            'email.unique' => 'ایمیل وارد شده قبلا در سامانه ثبت نام کرده است',
            'email.*' => "ایمیل خود را صحیح وارد کنید",
        ];
    }
}
