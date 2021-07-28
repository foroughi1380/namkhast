<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthRequestRequest extends FormRequest
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
            "nationalCode" => "required|nationalCode",
            "ncPicture" => "file|image|max:1000",
            "token" => "required|captcha:authUser"
        ];
    }

    public function messages()
    {
        return [
            "nationalCode.*" => "کد ملی وارد شده صحیح نمیباشد",
            "ncPicture.*" => "حجم عکس ارسالی باید کمتر از یک مگابایت باشد."
        ];
    }
}
