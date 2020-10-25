<?php

namespace App\Rules;

use App\Models\AttributeTranslation;
use Illuminate\Contracts\Validation\Rule;

class UniqueAttributeName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $attributeID;
    private  $attributeTranslate;
    public function __construct($attributeID,$attributeTranslate)
    {

        $this->attributeID=$attributeID;
        $this->attributeTranslate=$attributeTranslate;
       // dd(  $this->$attributeID);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {  //dd($this->attributeID);

        if ($this->attributeID){
            $attribute=AttributeTranslation::where('name',$value)->where('attribute_id','!=',$this->attributeID)->first();
        //   dd($attribute);
        }

        if ($attribute)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This'.trans('_dasboard.'.$this->attributeTranslate) .'Already exists before';
    }
}
