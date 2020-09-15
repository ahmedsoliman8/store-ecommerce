<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Brand extends Model
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
    protected $guarded=[];
    /**
     * @var array
     */
    protected $casts=[
        "is_active"=>"boolean"
    ];
    protected $appends = ['main_photo'];


    function getMainPhotoAttribute() {
        return  $this->photo !==null? asset('assets/'. $this->photo):'';
    }





    public  function getActive(){
        return $this->is_active?'مفعل':'غير مفعل';
    }




}
