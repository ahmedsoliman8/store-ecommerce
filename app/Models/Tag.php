<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Tag extends Model
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

    public $translatedAttributes=['name'];

    /**
     * @var array
     */
    protected $fillable=["slug","is_active"];

    /**
     * @var array
     */
    protected $casts=[
        "is_active"=>"boolean"
    ];

    public  function getActive(){
        return $this->is_active?'مفعل':'غير مفعل';
    }

    public  function scopeActive($query){
        return $query->where("is_active",1);
    }

}
