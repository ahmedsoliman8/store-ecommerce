<?php

namespace App\Http\Requests;

use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AttributeUpdate extends FormRequest
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
        $rules=[

        ];
        $attribute=Attribute::find($this->id);
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {
            $rules += [$localeCode . '.name' => 'required',Rule::unique('attribute_translations', 'name')->ignore($attribute->id, 'attribute_id')];
        }

        return $rules;
    }
}
