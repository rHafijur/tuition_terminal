<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tutor;
use App\TutorPersonalInformation;
use App\Category;
use App\Course;
use App\City;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CityResource;

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
    public function dashboard(){
        $categories=Category::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection(Course::all());
        $city_collection=CityResource::collection(City::all());
        // return $city_collection;
        return view('tutor.dashboard',\compact('categories','categories_collection','courses_collection','city_collection'));
    }
}
