<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    /**
     * @var array
     */
    protected $fillable=['name','description','short_description'];
    public $timestamps=false;
}
