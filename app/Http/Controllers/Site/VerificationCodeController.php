<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationCodeRequest;
use Illuminate\Http\Request;
use App\Http\Services\VerificationServices;
use Illuminate\Support\Facades\Auth;

class VerificationCodeController extends Controller
{
    public $verification_services;
    public function __construct(VerificationServices $verification_services)
    {
        $this->verification_services=$verification_services;
    }

    public function verify(){
        if(Auth::user()->email_verified_at !== null){
            return redirect()->back();
        }
        return view('auth.verification');
    }
    public function verify_user(VerificationCodeRequest $request){
       $check= $this->verification_services->checkOTPCODE($request->code);
       if(!$check){
            return 'You Enter Wrong Code';
       }
       return redirect()->route('site.index');
    }

}
