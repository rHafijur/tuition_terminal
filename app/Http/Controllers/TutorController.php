<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tutor;
use App\TutorPersonalInformation;

class TutorController extends Controller
{
    public function create(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:13|min:11',
            'password' => 'required|confirmed|max:100|min:6',
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sms_otp' => rand(99999,999999),
            'cb_roles_id' => 3,
            'password' => Hash::make($request->password),
        ]);
        $tutor_id=Tutor::create([
            'user_id'  => $user->id
        ])->id;
        TutorPersonalInformation::create([
            'tutor_id'  => $tutor_id
            // 'tutor_id'  => 1
        ]);
        $user->sendEmailVerificationNotification();
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return view('auth.verify');
    }
}
