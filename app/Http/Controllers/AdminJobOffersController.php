<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Http\Request;

use App\JobOffer;
use App\Category;
use App\Course;
use App\City;
use App\Tutor;
use App\Institute;
use App\JobApplication;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CityResource;

class AdminJobOffersController extends CBController {

    protected function redirectIfNotSuperAdmin(){
        if(auth()->user()->cb_roles_id!=1){
            return cb()->redirectBack('Unauthorized Operation','warning');
        }
    }

    public function cbInit()
    {
        $this->setTable("job_offers");
        $this->setPermalink("job_offers");
        $this->setPageTitle("Job Offers");

        $this->addText("ID","id");
    }
    public function getChangeActive($id,$stat){
        $job_offer=JobOffer::findOrFail($id);
        $job_offer->is_active=$stat;
        $job_offer->save();
        return $job_offer->is_active;
    }
    public function getAll(){
        $page_title = "All Job Offers";
        $job_offers = JobOffer::latest()->get();
        // dd($job_offers);
        return view('admin.job_offers.all',\compact('page_title','job_offers'));
    }
    public function getDetail($id){
        $page_title = "Job Offer Detail -".$id;
        $offer = JobOffer::findOrFail($id);
        // dd($job_offers);
        return view('admin.job_offers.detail',\compact('page_title','offer'));
    }
    public function getEdit($id){
        $page_title = "Edit Job Offers";
        $offer = JobOffer::findOrFail($id);
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());
        return view('admin.job_offers.edit_offer',compact('page_title','offer','courses','categories','categories_collection','courses_collection','city_collection','institutes'));
    }
    public function postUpdate(Request $request){
        $offer=JobOffer::findOrFail($request->id);
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
        return cb()->redirectBack('Job offer has been deleted successfully','success');
    }
    public function getDelete($id){
        if(auth()->user()->cb_roles_id==!1){
            return redirect()->back();
        }
        $offer=JobOffer::findOrFail($id);
        $offer->delete();
        return cb()->redirectBack('Job offer has been deleted successfully','success');
    }

    public function getApplicationList($id){
        $page_title = "Applications of Job Id: ".$id;
        $offer = JobOffer::findOrFail($id);
        return view('admin.job_offers.single_job_applications',compact('page_title','offer'));
    }
    public function getApplicationTake($id){
        $application=JobApplication::findOrFail($id);
        $offer=$application->job_offer;
        $user_id=auth()->user()->id;
        if($offer->taken_by_1_id==null){
            $offer->taken_by_1_id=$user_id;
            $application->taken_by_id=$user_id;
            $offer->save();
            $application->save();
        }elseif($offer->taken_by_2_id==null){
            $offer->taken_by_2_id=$user_id;
            $application->taken_by_id=$user_id;
            $offer->save();
            $application->save();
        }
        return redirect()->back();
    }
    public function postApplicationUpdateNote(Request $request){
        $application=JobApplication::findOrFail($request->id);
        $application->note=$request->note;
        $application->save();
        return cb()->redirectBack('Note Updated Successfully','success');
    }
    public function postNewApplication(Request $request){
        $tutor=Tutor::where('tutor_id',$request->tutor_id)->first();
        if($tutor==null){
            return cb()->redirectBack('Wrong Tutor Id','warning');
        }
        $offer = JobOffer::findOrFail($request->id);
        $applied=$offer->applications()->where('tutor_id',$tutor->id)->first();
        if($applied!=null){
            return cb()->redirectBack('The Given Tutor Already Applied','warning');
        }
        JobApplication::create([
            'job_offer_id'=>$offer->id,
            'tutor_id'=>$tutor->id,
        ]);
        return cb()->redirectBack('New Tutor added to the job offer!','success');

    }
    public  function getApplicationDelete($id){
        $this->redirectIfNotSuperAdmin();
        $application=JobApplication::findOrFail($id);
        $application->delete();
        return cb()->redirectBack("Application Deleted Successfully",'success');
    }
}
