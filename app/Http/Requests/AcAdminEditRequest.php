<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcAdminEditRequest extends FormRequest
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
            "name" => "required|max:50",
            "family" => "required|max:70",
            "phone" => "required|digits:11|regex:/^09\d{9}$/|unique:admin,phone",
            "email" => "required|unique:admin,email",
        ];
    }
    public function messages()
    {
        return [
            "phone.exists" => 'شماره تلفن وارد شده در سامانه وجود دارد',
            "phone.*" => 'شماره تلفن وارد شده صحیح نمیباشد',
            "email" => 'ایمیل وارد شده تکراری است'
        ];
    }

}
