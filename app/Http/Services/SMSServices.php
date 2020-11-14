<?php

namespace App\Http\Services;
use App\Models\VerificationCode;

class SMSServices
{

    public  function setVerificationCode($data){

        $code=mt_rand(100000,999999);
        $data["code"]=$code;
        VerificationCode::whereNotNull("user_id")->where(["user_id"=>$data["user_id"]])->delete();
      //  VerificationCode::whereNotNull("receiver")->where(["receiver"=>$data["receiver"]])->delete();
       return VerificationCode::create($data);
    }

}
