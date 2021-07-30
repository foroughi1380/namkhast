<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
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
            'price' => 'required|numeric|min:50000',
            'token' =>  'required|captcha:submitRequest'
        ];
    }

    public function messages()
    {
        return [
            "price.*" =>   'مبلغ وارد شده نادرست است',
            "token.required" => 'کد کپچا به سمت سرور ارسال نشده است لطفا دباره تلاش کنید.'
        ];
    }
}
