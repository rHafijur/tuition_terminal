<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JobOffer;
use App\Category;
use App\Course;
use App\City;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CityResource;

class JobOfferController extends Controller
{
    public function create_offer_form(){
        $categories=Category::all();
        $courses=Course::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());

        return view('parent.create_offer',\compact('courses','categories','categories_collection','courses_collection','city_collection'));
    }
    public function create(Request $request){
        // dd($request);
        $jobOffer= JobOffer::create([
            'parent_id'=> auth()->user()->parents->id,
            'category_id'=> $request->category_id,
            'course_id'=> $request->course_id,
            'city_id'=> $request->city_id,
            'location_id'=> $request->location_id,
            'teaching_method_id'=> $request->teaching_method_id,
            'name'=> $request->name,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'days_in_week'=> $request->days_in_week,
            'time'=> $request->time,
            'min_salary'=> $request->min_salary,
            'max_salary'=> $request->max_salary,
            'student_gender'=> $request->student_gender,
            'tutor_gender'=> $request->tutor_gender,
            'name_of_institute'=> $request->name_of_institute,
            'number_of_students'=> $request->number_of_students,
            'requirements'=> $request->requirements,
            'hiring_from'=> $request->hiring_from,
            'status'=> -1,
            'is_active'=> 0,
        ]);
        $jobOffer->course_subjects()->sync($request->course_subject_ids);
        // $jobOffer->teaching_methods()->sync($request->teaching_method_ids);
        return redirect()->back()->with('success','Job offer has been created successfully');
    }
}
