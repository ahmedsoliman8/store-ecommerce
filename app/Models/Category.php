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
    protected $fillable=["category_id","slug","is_active"];
    /**
     * @var array
     */
    protected $casts=[
      "is_active"=>"boolean"
    ];

    public  function scopeParent($query){
        return $query->whereNull('category_id');
    }


    public  function scopeChild($query){
        return $query->whereNotNull('category_id');
    }

    public  function getActive(){
        return $this->is_active?'مفعل':'غير مفعل';
    }

    public  function categories(){
        return $this->hasMany(Category::class)->select(['id','category_id','slug']);
    }

    public  function scopeActive($query){
        return $query->where("is_active",1);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories')->Active()->select(['id','category_id','slug']);
    }

}









