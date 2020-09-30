<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,SoftDeletes;

    /**
     * @var array
     */
    protected $with=["translations"];

    protected $fillable=[
        'slug',
        'brand_id',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active'
    ];
    /**
     * @var array
     */
    protected $casts=[
        "is_active"=>"boolean",
        "manage_stock"=>"boolean",
        "in_stock"=>"boolean"
    ];
    /**
     * @var array
     */
    protected $dates=[
        "special_price_start",
        "special_price_end",
        "deleted_at"
    ];
    /**
     * @var array
     */
    public $translatedAttributes=['name','description','short_description'];

    public  function brand(){
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public  function categories(){
        return $this->belongsToMany(Category::class,'product_categories');
    }
    public  function tags(){
        return $this->belongsToMany(Tag::class,'product_tags');
    }
    public  function getActive(){
        return $this->is_active?'مفعل':'غير مفعل';
    }
    public  function scopeActive($query){
        return $query->where("is_active",1);
    }


}



