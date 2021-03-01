<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\User;

class OtpVerificationController extends Controller
{
    public function index(){
        return view('auth.verify_otp');
    }
    public function resend(){
        auth()->user()->sendOtpSms();
        return redirect()->back()->with('success','OTP re-sent successfully');
    }
    public function forgot_password_resend_otp(Request $request){
        $user=User::findOrFail(\decrypt($request->id));
        $user->sendRestOTP();
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
    public function verify_forgot_password_otp(Request $request){
        $user=User::findOrFail(decrypt($request->id));
        if($request->otp==$user->sms_otp){
            return redirect()->route('forgot_reset_password',['id'=>$request->id]);
        }
        return redirect()->back()->with('error','OTP could not be verified!');
    }
    public function send_forgot_otp(Request $request){
        $user = User::where('phone',$request->email)->orWhere('email',$request->email)->first();
        if($user==null){
            // return redirect()->back()->withError("");
            throw ValidationException::withMessages(['email' => 'No Phone or Email address found!']);
        }
        // dd($user);
        $user->sendRestOTP();
        return redirect()->route('forgot_password_otp',['id'=>\encrypt($user->id)]);
    }
}
