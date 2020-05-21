<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\Currency;
use App\Enum\Language;
use App\Enum\Unit;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
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
            "name"     => ["required"],
            "category" => ["nullable", Rule::in(Category::all()->pluck("id")->toArray())],
            "currency" => ["required", Rule::in(Currency::getCurrencies())],
            "price"    => ["required", "numeric", "min:0"],
            "unit"     => ["required", Rule::in(Unit::getUnits())],
            "quantity" => ["required", "integer", "min:0"],
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
                "name.required"     => "حقل الاسم مطلوب.",
                "category.in"       => "الصنف المحدد غير مقبول.",
                "currency.required" => "حقل العملة مطلوب.",
                "currency.in"       => "العملة المحدد غير مقبول.",
                "price.required"    => "حقل السعر مطلوب.",
                "price.numeric"     => "يجب أن يكون السعر رقماً.",
                "price.min"         => "يجب أن يكون السعر 0 على الأقل.",
                "unit.required"     => "حقل التعبة مطلوب.",
                "unit.in"           => "التعبة المحدد غير مقبولة.",
                "quantity.required" => "حقل الكمية مطلوب.",
                "quantity.integer"  => "يجب أن تكون الكمية عددًا صحيحًا.",
                "quantity.min"      => "يجب أن تكون الكمية 0 على الأقل."
            ];

        return parent::messages();
    }
}
