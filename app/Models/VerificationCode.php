<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{


    protected  $table="users_verficationcodes";

    /**
     * @var array
     */
    protected $fillable=["user_id","code"];









}
