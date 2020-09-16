<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TagUpdate extends FormRequest
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
            'slug'=>'required|unique:tags,slug,'.$this->id,

        ];
        $tag=Tag::find($this->id);
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {
            $rules += [$localeCode . '.name' => 'required',Rule::unique('tag_translations', 'name')->ignore($tag->id, 'tag_id')];
        }

        return $rules;
    }
}
