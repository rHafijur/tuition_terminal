<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    public function index(){
        return view('auth.verify_otp');
    }
    public function resend(){
        auth()->user()->sendOtpSms();
        return redirect()->back()->with('success','OTP re-sent successfully');
    }
    public function verify(Request $request){
        $user=auth()->user();
        if($request->otp==$user->sms_otp){
            $user->phone_verified_at=now();
            $user->save();
            return redirect("/home");
        }
        return redirect()->back()->with('error','OTP could not be verified!');
    }
}
