<?php

namespace App\Http\Services;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;

class VerificationServices
{

    public  function setVerificationCode($data){

        $code=mt_rand(100000,999999);
        $data["code"]=$code;
        VerificationCode::whereNotNull("user_id")->where(["user_id"=>$data["user_id"]])->delete();
      //  VerificationCode::whereNotNull("receiver")->where(["receiver"=>$data["receiver"]])->delete();
       return VerificationCode::create($data);
    }
    public function getSMSVerifyMessageByAppName( $code)
    {
        $message = " is your verification code for your account";


        return $code.$message;
    }
    public  function checkOTPCODE($code){
        if(Auth::guard()->check()){
        $verificationData=   VerificationCode::where('user_id',Auth::id())->first();
        //dd( $verificationData);
        if(!is_null($verificationData)&&$verificationData->code==$code){
            User::where('id',Auth::id())->update([
               'email_verified_at'=>now()
            ]);
            return true;
        }
        return false;
        }
        return false;
    }

}
