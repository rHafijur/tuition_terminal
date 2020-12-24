<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user->sendEmailVerificationNotification();
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // return view('auth.verify');
        // return redirect(route('tutor_registration')."?tab=pi")->with('success','Tutor Account Created Successfully. Please Complete your profile');
    }
    public function profile(){
        $user= auth()->user();
        return view('parent.view_profile',\compact('user'));
    }
    public function edit_profile(){
        $user= auth()->user();
        return view('parent.edit_profile',\compact('user'));
    }
    public function update_profile(Request $request){
        $user= auth()->user();
        $user->name=$request->name;
		$user->email=$request->email;
		$user->phone=$request->phone;
		$user->save();
        return redirect()->back()->with('success','Profile Successfully updated');
    }
    public function change_password(){
        // dd(1);
        return view('parent.change_password');
    }
    public function update_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed|max:100|min:6',
        ]);
        $user = auth()->user();
        if(Hash::check($request->current_password, $user->password)){
            $user->password= Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success','Password Successfully Changed');
        }
        return redirect()->back()->with('incorrect_password','Incorrect Password');
    }
}