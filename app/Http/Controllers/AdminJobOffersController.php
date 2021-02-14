<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        $this->middleware('admin');
        
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
        $request=request();
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());
        $all_offer_cnt=JobOffer::all()->count();
        $available_offer_cnt=JobOffer::where(function($q){
            return $q->whereNull('taken_by_1_id')->orWhereNull('taken_by_2_id');
        })->get()->count();
        $pending_offer_cnt=JobOffer::whereHas('applications',function($q){
            return $q->whereNull('current_stage')->orWhereIn('current_stage',['waiting','meet','trial']);
        })->get()->count();
        $todays_offer_cnt=JobOffer::whereDate('created_at',Carbon::today())->get()->count();

        $job_offers = JobOffer::select("*");
        $q=$request->q;
        if($q!=null){
			$job_offers=$job_offers->where('id',$q)
						 ->orWhere('phone',$q)
						 ->orWhere('name','like','%'.$q.'%');
		}
        if($request->from!=null && $request->to!=null){
            $job_offers= $job_offers->whereBetween('created_at',[$request->from,$request->to]);
        }else{
            if($request->from!=null){
                $job_offers= $job_offers->whereBetween('created_at',[$request->from,now()]);
            }
        }
        if($request->city_id!=null){
            $job_offers= $job_offers->where('city_id',$request->city_id);
        }
        if($request->location_id!=null){
            $job_offers= $job_offers->where('location_id',$request->location_id);
        }
        if($request->category_id!=null){
            $job_offers= $job_offers->where('category_id',$request->category_id);
        }
        if($request->course_id!=null){
            $job_offers= $job_offers->where('course_id',$request->course_id);
        }
        if($request->course_subject_ids!=null && count($request->course_subject_ids)>0){
            $job_offers= $job_offers->whereHas('course_subjects',function($query) use($request){
                return $query->whereIn('id',$request->course_subject_ids);
            });
        }
        if($request->salary!=null){
            $job_offers= $job_offers->where('min_salary','<=',$request->salary)->where('max_salary','>=',$request->salary);
        }
        if($request->source!=null){
            $job_offers= $job_offers->where('source',$request->source);
        }
        if($request->tutor_gender!=null){
            $job_offers= $job_offers->where('tutor_gender',$request->tutor_gender);
        }
        if($request->tutor_department!=null){
            $job_offers= $job_offers->where('tutor_department',$request->tutor_department);
        }
        if($request->reference_name!=null){
            $job_offers= $job_offers->where('reference_name',$request->reference_name);
        }
        if($request->time!=null){
            $job_offers= $job_offers->where('time',$request->time);
        }
        if($request->taken_by_id!=null){
            $job_offers= $job_offers->where(function($query) use($request){
                return $query->where('taken_by_1_id',$request->taken_by_id)->orWhere('taken_by_2_id',$request->taken_by_id);
            });
        }
        // dd($job_offers->get(),$job_offers,$request);
        // $job_offers = JobOffer::all();
        $job_offers = $job_offers->latest()->get();
        // dd($categories_collection);
        return view('admin.job_offers.all',\compact('page_title','request','job_offers','courses','categories','categories_collection','courses_collection','city_collection','institutes','all_offer_cnt','available_offer_cnt','pending_offer_cnt','todays_offer_cnt'));
    }
    public function getAvailableOffers(){
        $page_title = "Available Job Offers";
        $request=request();
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());

        $all_offer_cnt=JobOffer::all()->count();
        $available_offer_cnt=JobOffer::where(function($q){
            return $q->whereNull('taken_by_1_id')->orWhereNull('taken_by_2_id');
        })->get()->count();
        $pending_offer_cnt=JobOffer::whereHas('applications',function($q){
            return $q->whereNull('current_stage')->orWhereIn('current_stage',['waiting','meet','trial']);
        })->get()->count();
        $todays_offer_cnt=JobOffer::whereDate('created_at',Carbon::today())->get()->count();

        $job_offers = JobOffer::where(function($q){
            return $q->whereNull('taken_by_1_id')->orWhereNull('taken_by_2_id');
        });
        $q=$request->q;
        if($q!=null){
			$job_offers=$job_offers->where('id',$q)
						 ->orWhere('phone',$q)
						 ->orWhere('name','like','%'.$q.'%');
		}
        if($request->from!=null && $request->to!=null){
            $job_offers= $job_offers->whereBetween('created_at',[$request->from,$request->to]);
        }else{
            if($request->from!=null){
                $job_offers= $job_offers->whereBetween('created_at',[$request->from,now()]);
            }
        }
        if($request->city_id!=null){
            $job_offers= $job_offers->where('city_id',$request->city_id);
        }
        if($request->location_id!=null){
            $job_offers= $job_offers->where('location_id',$request->location_id);
        }
        if($request->category_id!=null){
            $job_offers= $job_offers->where('category_id',$request->category_id);
        }
        if($request->course_id!=null){
            $job_offers= $job_offers->where('course_id',$request->course_id);
        }
        if($request->course_subject_ids!=null && count($request->course_subject_ids)>0){
            $job_offers= $job_offers->whereHas('course_subjects',function($query) use($request){
                return $query->whereIn('id',$request->course_subject_ids);
            });
        }
        if($request->salary!=null){
            $job_offers= $job_offers->where('min_salary','<=',$request->salary)->where('max_salary','>=',$request->salary);
        }
        if($request->source!=null){
            $job_offers= $job_offers->where('source',$request->source);
        }
        if($request->tutor_gender!=null){
            $job_offers= $job_offers->where('tutor_gender',$request->tutor_gender);
        }
        if($request->tutor_department!=null){
            $job_offers= $job_offers->where('tutor_department',$request->tutor_department);
        }
        if($request->reference_name!=null){
            $job_offers= $job_offers->where('reference_name',$request->reference_name);
        }
        if($request->time!=null){
            $job_offers= $job_offers->where('time',$request->time);
        }
        if($request->taken_by_id!=null){
            $job_offers= $job_offers->where(function($query) use($request){
                return $query->where('taken_by_1_id',$request->taken_by_id)->orWhere('taken_by_2_id',$request->taken_by_id);
            });
        }
        // dd($job_offers->get(),$job_offers,$request);
        // $job_offers = JobOffer::all();
        $job_offers = $job_offers->latest()->get();
        // dd($categories_collection);
        return view('admin.job_offers.available',\compact('page_title','request','job_offers','courses','categories','categories_collection','courses_collection','city_collection','institutes','all_offer_cnt','available_offer_cnt','pending_offer_cnt','todays_offer_cnt'));
    }

    public function getApplications(){
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());

        $request=\request();
        $page_title = "Job Offers Applications";
        $todays_cnt= JobApplication::whereDate('created_at',Carbon::today())->get()->count();
        $total_cnt= JobApplication::all()->count();
        $offers = JobOffer::select("*");
        if($request->from!=null && $request->to!=null){
            $offers= $offers->whereBetween('created_at',[$request->from,$request->to]);
        }else{
            if($request->from!=null){
                $offers= $offers->whereBetween('created_at',[$request->from,now()]);
            }
        }
        if($request->city_id!=null){
            $offers= $offers->where('city_id',$request->city_id);
        }
        if($request->location_id!=null){
            $offers= $offers->where('location_id',$request->location_id);
        }
        if($request->category_id!=null){
            $offers= $offers->where('category_id',$request->category_id);
        }
        if($request->course_id!=null){
            $offers= $offers->where('course_id',$request->course_id);
        }
        if($request->course_subject_ids!=null && count($request->course_subject_ids)>0){
            $offers= $offers->whereHas('course_subjects',function($query) use($request){
                return $query->whereIn('id',$request->course_subject_ids);
            });
        }
        if($request->reference_name!=null){
            $offers= $offers->where('reference_name',$request->reference_name);
        }
        // $applications->dd();
        $offers = $offers->whereHas('applications',function($qu) use($request){
            $qu= $qu->whereHas('tutor',function($q) use($request){
                if($request->tutor_city_id!=null){
                    $q= $q->where('city_id',$request->tutor_city_id);
                }
                if($request->tutor_location_id!=null){
                    $q= $q->where('location_id',$request->tutor_location_id);
                }
                if($request->tutor_gender!=null){
                    $q= $q->whereHas('tutor_personal_information',function($qu) use($request){
                        return $qu->where('gender',$request->tutor_gender);
                    });
                }
            });
            return $qu->orderBy('created_at','desc');
        });
        // dd($offers->get());
        $offers=$offers->get();
        return view('admin.job_offers.applications',compact('page_title','request','courses','categories','categories_collection','courses_collection','city_collection','institutes','offers','total_cnt','todays_cnt'));
    }
    public function getAdd_new(){
        $page_title="New Job Offer";
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());
        return view('admin.job_offers.add_new',\compact('page_title','courses','categories','categories_collection','courses_collection','city_collection','institutes'));
    }
    public function postSaveNew(){
        $request=\request();
        $jobOffer= JobOffer::create([
            'parent_id'=> $request->parent_id,
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
            'status'=> 1,
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
        return cb()->redirect(cb()->getAdminUrl("job_offers/available-offers"),'Job offer saved successfully','success');
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
        $offer->applications()->update(['is_seen'=>1]);
        return view('admin.job_offers.single_job_applications',compact('page_title','offer'));
    }
    public function getApplicationTake($id){
        $application=JobApplication::findOrFail($id);
        $offer=$application->job_offer;
        $user_id=auth()->user()->id;
        if($offer->taken_by_1_id==null){
            $offer->taken_by_1_id=$user_id;
            $application->taken_by_id=$user_id;
            $application->taken_at=now();
            $offer->save();
            $application->save();
        }elseif($offer->taken_by_2_id==null){
            $offer->taken_by_2_id=$user_id;
            $application->taken_by_id=$user_id;
            $application->taken_at=now();
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
    public function getOfferCurrentCondition($id){
        $offer = JobOffer::findOrFail($id);
        return view('admin.job_offers.src.current_condition_ajax',compact('offer'));
    }
    public function getOfferSearchTutor($id){
        $offer = JobOffer::findOrFail($id);
        $tutors =$offer->search_tutors_by_matching();
        // dd($tutors);
        return view('admin.job_offers.src.search_tutor_modal_ajax',compact('offer','tutors'));
    }
}
