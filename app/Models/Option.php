<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Option extends Model
{

    use Translatable;

    /**
     * @var array
     */
    protected $with=["translations"];
    /**
     * @var array
     */
    protected $hidden=["translations"];

    /**
     * @var array
     */
    public $translatedAttributes=['name'];

    /**
     * @var array
     */
    protected $fillable=["attribute_id","product_id"];

    public  function product(){
        return $this->belongsTo(Product::class)->withDefault();
    }

    public  function attribute(){
        return $this->belongsTo(Attribute::class)->withDefault();
    }


}
