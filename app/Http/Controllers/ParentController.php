<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function dashboard(){
        return view('parent.dashboard');
    }
    public function create(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:11|min:11',
            'password' => 'required|confirmed|max:100|min:6',
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sms_otp' => rand(99999,999999),
            'cb_roles_id' => 2,
            'password' => Hash::make($request->password),
        ]);
        $tutor=Tutor::create([
            'user_id'  => $user->id
        ]);
        $tutor->save_tutor_id();
        TutorPersonalInformation::create([
            'tutor_id'  => $tutor->id
            // 'tutor_id'  => 1
        ]);
        // $user->sendEmailVerificationNotification();
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // return view('auth.verify');
        // return redirect(route('tutor_registration')."?tab=pi")->with('success','Tutor Account Created Successfully. Please Complete your profile');
    }
}
