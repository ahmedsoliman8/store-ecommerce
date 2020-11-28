<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MainCategoryUpdate extends FormRequest
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
            'slug'=>'required|unique:categories,slug,'.$this->id,
            'category_id'=>'sometimes|nullable|numeric'
        ];
        $category=Category::find($this->id);
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {
            $rules += [$localeCode . '.name' => 'required',Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')];
        }

        return $rules;
    }
}
