<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\Language;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
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
        $categories = Category::all()->pluck("id")->toArray();
        return [
            "name"   => ["required"],
            "image"  => ["nullable", "mimes:png", "max:2048"],
            "parent" => ["nullable", Rule::in($categories)]
        ];
    }

    /**
     * Get the messages that apply to the validation rules in the request.
     *
     * @return array|string[]
     */
    public function messages()
    {
        if(app()->getLocale() == Language::ARABIC)
            return [
                "name.required" => "حقل الاسم مطلوب.",
                "image.mimes"   => "يجب أن يكون نوع الصورة فقط png.",
                "image.max"     => "يجب ان يكون حجم الصورة اقل من (2MB).",
                "parent.in"     => "الصنف الرئيسي غير مقبول."
            ];

        return parent::messages();
    }
}
