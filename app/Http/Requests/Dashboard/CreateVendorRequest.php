<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\AdminState;
use App\Enum\Language;
use App\Enum\VendorState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVendorRequest extends FormRequest
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
            "vendorName"     => ["required", "unique:vendors,name"],
            "vendorEmail"    => ["required", "email", "unique:vendors,email"],
            "vendorPhone"    => ["required", "unique:vendors,phone"],
            "vendorState"    => ["required", Rule::in(VendorState::getStates())],
            "adminName"      => ["required"],
            "adminUsername"  => ["required", "unique:admins,username"],
            "adminPassword"  => ["required", "min:8", "confirmed"],
            "adminState"     => ["required", Rule::in(AdminState::getStates())]
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
                "vendorName.required"    => "حقل اسم الفرع مطلوب.",
                "vendorName.unique"      => "اسم الفرع محجوز.",
                "vendorEmail.required"   => "حقل البريد الإلكتروني مطلوب.",
                "vendorEmail.email"      => "البريد الالكتروني غير مقبول.",
                "vendorEmail.unique"     => "البريد الالكتروني محجوز.",
                "vendorPhone.required"   => "حقل الهاتف مطلوب.",
                "vendorPhone.unique"     => "الهاتف محجوز.",
                "vendorState.required"   => "حقل الحالة مطلوب.",
                "vendorState.in"         => "الحالة المحدد غير مقبول.",
                "adminName.required"     => "حقل الاسم الحقيقي مطلوب.",
                "adminUsername.required" => "حقل اسم المستخدم مطلوب.",
                "adminUsername.unique"   => "اسم المستخدم محجوز.",
                "adminPassword.required"  => "حقل كلمة المرور مطلوب.",
                "adminPassword.min"       => "يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.",
                "adminPassword.confirmed" => "كلمتا المرور غير متطابقتان.",
                "adminState.required"    => "حقل الحالة مطلوب.",
                "adminState.in"          => "الحالة المحدد غير مقبول."
            ];

        return parent::messages();
    }
}
