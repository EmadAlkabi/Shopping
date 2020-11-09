<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\AdminState;
use App\Enum\Language;
use App\Enum\VendorState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest
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
        dd($this->vendor);
        return [
            "name"  => ["required", "unique:vendors,name"],
            "email" => ["required", "email", "unique:vendors,email"],
            "phone" => ["required", "unique:vendors,phone"]
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
                "name.required"  => "حقل اسم الفرع مطلوب.",
                "name.unique"    => "اسم الفرع محجوز.",
                "email.required" => "حقل البريد الإلكتروني مطلوب.",
                "email.email"    => "البريد الالكتروني غير مقبول.",
                "email.unique"   => "البريد الالكتروني محجوز.",
                "phone.required" => "حقل الهاتف مطلوب.",
                "phone.unique"   => "الهاتف محجوز."
            ];

        return parent::messages();
    }
}
