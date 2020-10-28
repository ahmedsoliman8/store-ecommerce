<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    /**
     * @var array
     */
    protected $fillable=['name'];
    public $timestamps=false;
}
