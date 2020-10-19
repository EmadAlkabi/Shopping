<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\Language;
use Illuminate\Foundation\Http\FormRequest;

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
            "username" => ["required", "exists:admins,username"],
            "password" => ["required"]
        ];
    }

    /**
     * Get the messages that apply to the validation rules in the request.
     *
     * @return array
     */
    public function messages()
    {
        if(app()->getLocale() == Language::ARABIC)
            return [
                "username.required" => "حقل اسم المستخدم مطلوب",
                "username.exists"   => "اسم المستخدم غير موجود",
                "password.required" => "حقل كلمة المرور مطلوب",
            ];

        return parent::messages();
    }
}
