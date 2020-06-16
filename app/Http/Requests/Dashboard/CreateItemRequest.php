<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\Currency;
use App\Enum\Language;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateItemRequest extends FormRequest
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
            "name"       => ["required"],
            "category"   => ["nullable", Rule::in(Category::all()->pluck("id")->toArray())],
            "currency"   => ["required", Rule::in(Currency::getCurrencies())],
            "quantity-1" => ["exclude_if:unit-1,", "required", "integer", "min:0"],
            "quantity-2" => ["exclude_if:unit-2,", "required", "integer", "min:0"],
            "quantity-3" => ["exclude_if:unit-3,", "required", "integer", "min:0"],
            "name-1"     => ["exclude_if:unit-1," , "required"],
            "name-2"     => ["exclude_if:unit-2," , "required"],
            "name-3"     => ["exclude_if:unit-3," , "required"],
            "price-1"    => ["exclude_if:unit-1,", "required", "numeric", "min:0"],
            "price-2"    => ["exclude_if:unit-2,", "required", "numeric", "min:0"],
            "price-3"    => ["exclude_if:unit-3,", "required", "numeric", "min:0"]
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
                "name.required"       => "حقل الاسم مطلوب.",
                "category.in"         => "الصنف المحدد غير مقبول.",
                "currency.required"   => "حقل العملة مطلوب.",
                "currency.in"         => "العملة المحدد غير مقبول.",
                "quantity-1.required" => "حقل الكمية مطلوب.",
                "quantity-2.required" => "حقل الكمية مطلوب.",
                "quantity-3.required" => "حقل الكمية مطلوب.",
                "quantity-1.integer"  => "يجب أن تكون الكمية رقماً صحيحاً.",
                "quantity-2.integer"  => "يجب أن تكون الكمية رقماً صحيحاً.",
                "quantity-3.integer"  => "يجب أن تكون الكمية رقماً صحيحاً.",
                "quantity-1.min"      => "يجب أن تكون الكمية 0 على الأقل.",
                "quantity-2.min"      => "يجب أن تكون الكمية 0 على الأقل.",
                "quantity-3.min"      => "يجب أن تكون الكمية 0 على الأقل.",
                "name-1.required"     => "حقل الاسم مطلوب.",
                "name-2.required"     => "حقل الاسم مطلوب.",
                "name-3.required"     => "حقل الاسم مطلوب.",
                "price-1.required"    => "حقل السعر مطلوب.",
                "price-2.required"    => "حقل السعر مطلوب.",
                "price-3.required"    => "حقل السعر مطلوب.",
                "price-1.numeric"     => "يجب أن يكون السعر رقماً.",
                "price-2.numeric"     => "يجب أن يكون السعر رقماً.",
                "price-3.numeric"     => "يجب أن يكون السعر رقماً.",
                "price-1.min"         => "يجب أن يكون السعر 0 على الأقل.",
                "price-2.min"         => "يجب أن يكون السعر 0 على الأقل.",
                "price-3.min"         => "يجب أن يكون السعر 0 على الأقل."
            ];

        return parent::messages();
    }
}
