<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;
    protected  $table="admins";
  //  protected $rememberTokenName = false;
    protected $guarded=[];
    public  $timestamps=true;
}
