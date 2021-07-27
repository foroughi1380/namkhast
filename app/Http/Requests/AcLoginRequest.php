<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcLoginRequest extends FormRequest
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
            "email" => "required|exists:admin,email",
            "password" => "required|min:6",
            "token" => "required"
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'ایمیل وارد شده نا معتبر است',
        ];
    }
}
