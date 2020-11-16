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

        return redirect(route('tutor_dashboard')."?tab=ti");
    }
    public function update_ei(Request $request){
        // dd($request);
        $tutor = auth()->user()->tutor;
        $degree_data=[
            "degree_id" => $request->degree,
            "degree_title" => $request->degree_title,
            "institute_id" => $request->institute,
            "id_no" => $request->id_no,
            "curriculum_id" => $request->curriculum,
            "group_or_major" => $request->group_or_major,
            "passing_year" => $request->passing_year,
            "gpa" => $request->gpa,
            "education_board" => $request->education_board,
            "currently_studying" => $request->currently_studing,
        ];
        if($tutor->tutor_degree==null){
            $tutor->tutor_degree()->create($degree_data);
        }else{
            $tutor->tutor_degree()->update($degree_data);
        }
        return redirect(route('tutor_dashboard')."?tab=ei");
    }
    public function update_pi(Request $request){
        // dd($request);
        $tutor = auth()->user()->tutor;
        $tutor->tutor_personal_information()->update([
        'city_id' => $request->city,
        'location_id' => $request->location,
        'gender' => $request->gender,
        'additional_phone' => $request->additional_phone,
        'full_address' => $request->full_address,
        'id_number' => $request->id_number,
        'nationality' => $request->nationality,
        'facebook_profile' => $request->facebook_profile,
        'blood_group' => $request->blood_group,
        'date_of_birth' => $request->date_of_birth,
        'fathers_name' => $request->fathers_name,
        'mothers_name' => $request->mothers_name,
        'fathers_phone' => $request->fathers_phone,
        'mothers_phone' => $request->mothers_phone,
        'emergency_name' => $request->emergency_name,
        'emergency_phone' => $request->emergency_phone,
        'short_description' => $request->short_description,
        'reasones_to_get_hired' => $request->reasones_to_get_hired,
        'overview' => $request->overview,
        ]);

        return redirect(route('tutor_dashboard')."?tab=pi");
    }
    public function view_info(){
        $tutor = auth()->user()->tutor;
        return view("tutor.view_info",\compact('tutor'));
    }
}
