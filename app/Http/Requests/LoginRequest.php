<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
            "phone" => "required|digits:11|regex:/^09\d{9}$/",
//            "phone" => "required|digits:11|regex:(0)?9\d{9}|exists:App\Model\User,phone",
            "code" => "digits:4",
            "_token" => "required"
        ];
    }

    public function messages()
    {
        return [
            "phone.exists" => 'شماره تلفن وارد شده در سامانه وجود ندارد',
            "phone.*" => 'شماره تلفن وارد شده صحیح نمیباشد',
            "code.*" =>   'کد وارد شده باید ۴ عدد باشد',
            "_token.required" => 'کد کپچا به سمت سرور ارسال نشده است لطفا دباره تلاش کنید.'
        ];
    }
}
