<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\Language;
use Illuminate\Foundation\Http\FormRequest;

class MediaImageRequest extends FormRequest
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
            'image'   => 'required',
            'image.*' => 'mimes:png|max:2048'
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
                "image.required" => "حقل الصورة مطلوب.",
                "image.*.mimes"  => "يجب أن يكون نوع الصورة فقط png.",
                "image.*.max"    => "يجب ان يكون حجم الصورة اقل من (2MB)."
            ];

        return parent::messages();
    }
}
