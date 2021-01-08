<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JobOffer;
use App\Category;
use App\Course;
use App\City;
use App\Tutor;
use App\Institute;
use App\ApplicationForTutor;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CityResource;


use DB as DB;

class JobOfferController extends Controller
{
    public function all(){
        $offers=auth()->user()->parents->job_offers()->paginate('10');
        return view('parent.all_offer',compact('offers'));
    }
    public function create_offer_form(){
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());
        // return $city_collection;

        return view('parent.create_offer',\compact('courses','categories','categories_collection','courses_collection','city_collection','institutes'));
    }
    public function init_offer_form(){
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());
        // return $city_collection;

        return view('parent.init_offer',\compact('courses','categories','categories_collection','courses_collection','city_collection','institutes'));
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
            'is_active'=> 1,
            'tutor_study_type_id'=> $request->tutor_study_type_id,
            'tutor_religion_id'=> $request->tutor_religion_id,
            'tutor_university_id'=> $request->tutor_university_id,
            'tutor_school_id'=> $request->tutor_school_id,
            'tutor_college_id'=> $request->tutor_college_id,
            'tutor_category_id'=> $request->tutor_category_id,
            'university_type'=> $request->university_type,
            'group'=> $request->group,
            'reference_name'=> $request->reference_name,
            'reference_contact'=> $request->reference_contact,
            'reference_city_id'=> $request->reference_city_id,
            'email'=> $request->email,
            'additional_contact'=> $request->additional_contact,
            'source'=> $request->source,
            'spicial_note'=> $request->spicial_note,
            'tutor_department'=> $request->tutor_department,
        ]);
        $jobOffer->course_subjects()->sync($request->course_subject_ids);
        if($request->from=="init"){
            return redirect()->route('parent.dashboard')->with('success','Job offer has been created successfully');
        }
        // $jobOffer->teaching_methods()->sync($request->teaching_method_ids);
        return redirect()->back()->with('success','Job offer has been created successfully');
    }
    public function view($id){
        $offer=auth()->user()->parents->job_offers()->where('id',$id)->first();
        if($offer==null){
            \abort(500);
        }
        return view('parent.view_offer',compact('offer'));
    }
    public function edit($id){
        $offer=auth()->user()->parents->job_offers()->where('id',$id)->first();
        if($offer==null){
            \abort(500);
        }
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());
        return view('parent.edit_offer',compact('offer','courses','categories','categories_collection','courses_collection','city_collection','institutes'));
    }
    public function update(Request $request){
        $offer=auth()->user()->parents->job_offers()->where('id',$request->id)->first();
        $offer->parent_id = auth()->user()->parents->id;
        $offer->category_id = $request->category_id;
        $offer->course_id = $request->course_id;
        $offer->city_id = $request->city_id;
        $offer->location_id = $request->location_id;
        $offer->teaching_method_id = $request->teaching_method_id;
        $offer->name = $request->name;
        $offer->phone = $request->phone;
        $offer->address = $request->address;
        $offer->days_in_week = $request->days_in_week;
        $offer->time = $request->time;
        $offer->min_salary = $request->min_salary;
        $offer->max_salary = $request->max_salary;
        $offer->student_gender = $request->student_gender;
        $offer->tutor_gender = $request->tutor_gender;
        $offer->name_of_institute = $request->name_of_institute;
        $offer->number_of_students = $request->number_of_students;
        $offer->requirements = $request->requirements;
        $offer->hiring_from = $request->hiring_from;
        $offer->tutor_study_type_id = $request->tutor_study_type_id;
        $offer->tutor_religion_id = $request->tutor_religion_id;
        $offer->tutor_university_id = $request->tutor_university_id;
        $offer->tutor_school_id = $request->tutor_school_id;
        $offer->tutor_college_id = $request->tutor_college_id;
        $offer->tutor_category_id = $request->tutor_category_id;
        $offer->university_type = $request->university_type;
        $offer->group = $request->group;
        $offer->reference_name = $request->reference_name;
        $offer->reference_contact = $request->reference_contact;
        $offer->reference_city_id = $request->reference_city_id;
        $offer->email = $request->email;
        $offer->additional_contact = $request->additional_contact;
        $offer->source = $request->source;
        $offer->spicial_note = $request->spicial_note;
        $offer->tutor_department = $request->tutor_department;
        $offer->save();
        $offer->course_subjects()->sync($request->course_subject_ids);
        return redirect()->back()->with('success','Job offer has been updated successfully');
    }
    public function matched_tutors($id){
        $offer=auth()->user()->parents->job_offers()->where('id',$id)->first();
        if($offer==null){
            \abort(500);
        }
        $tutors = Tutor::where('city_id',$offer->city_id)
        ->whereBetween('expected_salary',[$offer->min_salary,$offer->max_salary])
        ->whereHas('categories',function ($q) use($offer){
            $q->where('id',$offer->category_id);
        })
        ->whereHas('courses',function ($q) use($offer){
            $q->where('id',$offer->course_id);
        })
        ->whereHas('course_subjects',function ($q) use($offer){
            $ids=[];
            foreach($offer->course_subjects as $cs){
                $ids[]=$cs->id;
            }
            $q->whereIn('id',$ids);
        })
        ->whereHas('teaching_methods',function ($q) use($offer){
            $q->where('id',$offer->teaching_method_id);
        })
        ->whereHas('tutor_personal_information',function ($q) use($offer){
            $q->where('gender',$offer->tutor_gender);
        });
        
        // dd($tutors->get());
        $tutors= $tutors->get();
        return view('parent.matched_tutors',compact('tutors','offer'));
    }
    function apply_for_tutor(Request $request){
        ApplicationForTutor::create([
            'job_offer_id'=>$request->job_offer_id,
            'tutor_id'=>$request->tutor_id,
        ]);
        return redirect()->back()->with('success','Successfully applied for the tutor');
    }
}
