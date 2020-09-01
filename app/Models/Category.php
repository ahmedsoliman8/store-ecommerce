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







}









