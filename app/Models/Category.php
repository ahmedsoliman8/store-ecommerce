<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    protected $fillable=["parent_id","slug","is_active"];
    /**
     * @var array
     */
    protected $casts=[
      "is_active"=>"boolean"
    ];

    public  function scopeParent($query){
        return $query->whereNull('parent_id');
    }


    public  function scopeChild($query){
        return $query->whereNotNull('parent_id');
    }

    public  function getActive(){
        return $this->is_active?'مفعل':'غير مفعل';
    }

    public  function parents(){
        return $this->hasMany('App\Models\Category','id','parent_id');
    }




}









