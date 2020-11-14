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
        $tutor=auth()->user()->tutor;
        $categories=Category::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection(Course::all());
        $city_collection=CityResource::collection(City::all());
        // return $city_collection;
        // dd($tutor->course_subjects[0]);
        return view('tutor.dashboard',\compact('tutor','categories','categories_collection','courses_collection','city_collection'));
    }
    public function update_ti(Request $request){
        $tutor = auth()->user()->tutor;
        $tutor->city_id=$request->city;
        $tutor->location_id=$request->locations;
        $tutor->expected_salary=$request->expected_salary;
        $tutor->tutoring_experience=$request->tutoring_experience;
        $tutor->tutoring_experience_details=$request->tutoring_experience_details;
        $tutor->available_from=$request->available_from;
        $tutor->available_to=$request->available_to;
        $tutor->save();
        $tutor->categories()->sync($request->categories);
        $tutor->courses()->sync($request->courses);
        $tutor->course_subjects()->sync($request->subjects);
        $tutor->days()->sync($request->days);
        $tutor->prefered_locations()->sync($request->prefered_locations);
        $tutor->teaching_methods()->sync($request->teaching_methods);
        return redirect()->back();
    }
}
