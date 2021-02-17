<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Tutor;
use App\TutorNote;
use App\TutorPersonalInformation;
use App\Category;
use App\Course;
use App\City;
use App\Institute;
use App\Curriculum;
use App\Location;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CityResource;
use Carbon\Carbon;

class AdminTutorsController extends CBController {
    
	protected function institute_id($institute){
        if(is_numeric($institute)){
            return $institute;
        }
        $ins=Institute::where('title',$institute)->first();
        if($ins != null){
            return $ins->id;
        }
        return Institute::create([
            'title' => $institute,
            'type' => 'school'
        ])->id;
    }
	protected function curriculum_id($curriculum){
        if(is_numeric($curriculum)){
            return $curriculum;
        }
        $ins=Curriculum::where('title',$curriculum)->first();
        if($ins != null){
            return $ins->id;
        }
        return Curriculum::create([
            'title' => $curriculum,
        ])->id;
    }
	protected function city_id($city){
        if(is_numeric($city)){
            return $city;
        }
        $ins=City::where('name',$city)->first();
        if($ins != null){
            return $ins->id;
        }
        return City::create([
            'country_id' => 1,
            'name' => \ucfirst($city),
        ])->id;
    }
	protected function location_id($location,$city){
        if(is_numeric($location)){
            return $location;
        }
        $city_id=$this->city_id($city);
        $loc=Location::where('name',$location)->where('city_id',$city_id)->first();
        if($loc != null){
            return $loc->id;
        }
        return Location::create([
            'city_id' => $city_id,
            'name' => \ucfirst($location),
        ])->id;
    }

    protected function prefered_location_ids($str,$city){
        $ids=[];
        $locs= \explode(',',$str);
        foreach($locs as $loc){
            $ids[]=$this->location_id($loc,$city);
        }
        return $ids;
    }

    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("tutors");
        $this->setPermalink("tutors");
        $this->setPageTitle("Tutors");

        $this->addSelectTable("City","city_id",["table"=>"cities","value_option"=>"name","display_option"=>"name","sql_condition"=>""])->filterable(true);
		$this->addSelectTable("Location","location_id",["table"=>"locations","value_option"=>"id","display_option"=>"name","sql_condition"=>""])->filterable(true);
		$this->addText("Expected Salary","expected_salary")->filterable(true)->strLimit(150)->maxLength(255);
		$this->addText("Tutoring Experience","tutoring_experience")->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Tutoring Experience Detail","tutoring_experience_details")->strLimit(150);
		$this->addText("Is Verified","is_verified")->strLimit(150)->maxLength(255);
		$this->addText("Is Featured","is_featured")->strLimit(150)->maxLength(255);
		$this->addText("Is Premium","is_premium")->strLimit(150)->maxLength(255);
		$this->addDatetime("Premium Started At","premium_started_at");
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Available From","available_from")->strLimit(150)->maxLength(255);
		$this->addText("Available To","available_to")->strLimit(150)->maxLength(255);
		

	}
	public function postDelete(){
		if(!module()->canDelete()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		Tutor::find(request()->id)->user->delete();
		return redirect()->back()->with('success',"Tuter deleted successfully");
	}
	public function getSms($id){
		dd($id);
	}
	public function getEdit($id){
		if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$tutor=Tutor::findOrFail($id)->user;
		// \dd($tutor);
		$page_title="Edit Tutor";
		return view('admin.tutor.edit',\compact('tutor','page_title'));
	}
	public function postEdit(){
		if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $request=\request();
        $request->validate([
            'name' => 'required|max:100|min:3',
            'password' => 'required|confirmed',
            'email' => 'required|max:255',
            'phone' => 'required|max:13|min:11',
        ]);
		$user=User::findOrFail($request->id);
		$user->name=$request->name;
		$user->email=$request->email;
		$user->phone=$request->phone;
		$user->password=Hash::make($request->password);
		$user->save();
		return redirect()->back()->with('success',"Tutor's data Updated successfully");
	}
	public function postBulkSms(){
		$request=request();
		dd($request);
	}
	public function getIndex(){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $request=request();
        // dd($request);
        $reports=[];
        $reports['total']=Tutor::all()->count();
        $reports['premium']=Tutor::where('is_premium',1)->get()->count();
        $reports['featured']=Tutor::where('is_featured',1)->get()->count();
        $reports['male']=Tutor::whereHas('tutor_personal_information',function($q){
            return $q->where('gender','male');
        })->get()->count();
        $reports['female']=Tutor::whereHas('tutor_personal_information',function($q){
            return $q->where('gender','female');
        })->get()->count();
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());

		$q=$request->q;
		$limit=$request->limit;
		$city=$request->city;
		$location=$request->location;
		$is_verified=$request->is_verified;
		$is_featured=$request->is_featured;

		$page_title="All Tutors";
		
		if($limit==null){
			$limit=10;
        }
        $query= Tutor::latest();
        if($q!=null){
            $query= Tutor::select("tutors.*")->join('users','users.id','tutors.user_id');
			$query=$query->where('tutors.tutor_id','like','%'.$q.'%')
						 ->orWhere('users.name','like','%'.$q.'%')
						 ->orWhere('users.email','like','%'.$q.'%')
						 ->orWhere('users.phone','like','%'.$q.'%'); 
		}
        if($request->from!=null && $request->to!=null){
            $query= $query->whereBetween('created_at',[$request->from,$request->to]);
        }else{
            if($request->from!=null){
                $query= $query->whereBetween('created_at',[$request->from,now()]);
            }
        }
        if($preferred_location_id= $request->preferred_location_id){
            $query=$query->whereHas('pref_locations',function($q)use($preferred_location_id){
                return $q->where('location_id',$preferred_location_id);
            });
        }
        if($category_id= $request->category_id){
            $query=$query->whereHas('categories',function($q) use($request){
                return $q->where('category_id',$request->category_id);
            });
        }
        if($channel= $request->channel){
            $query=$query->whereHas('user',function($q) use($request){
                return $q->where('channel',$request->channel);
            });
        }
        $query = $query->whereHas('tutor_personal_information',function($q) use($request){
            if($city_id= $request->city_id){
                $q=$q->where('city_id',$city_id);
            }
            if($location_id= $request->location_id){
                $q=$q->where('location_id',$location_id);
            }
            if($tutor_gender= $request->tutor_gender){
                $q=$q->where('gender',$tutor_gender);
            }
            return $q;
        });
        if($request->year!=null || $request->university_type!=null || $request->study_type_id!=null || $request->institute_id!=null || $request->tutor_department!=null){
            $query = $query->whereHas('tutor_degrees',function($q) use($request){
                if($year= $request->year){
                    $q=$q->where('year_or_semester',$year);
                }
                if($university_type= $request->university_type){
                    $q=$q->where('university_type',$university_type);
                }
                if($study_type_id= $request->study_type_id){
                    $q=$q->where('study_type_id',$study_type_id);
                }
                if($institute_id= $request->institute_id){
                    $q=$q->where('institute_id',$institute_id);
                }
                if($tutor_department= $request->tutor_department){
                    $q=$q->where('department',$tutor_department);
                }
            });
        }
        // dd($query);
        $tutors=$query->orderBy('is_premium','desc')->paginate($limit);
        // dd($tutors);
		return view('admin.tutor.all',\compact('reports','tutors','institutes','categories_collection','city_collection','request','page_title'));
	}
	public function getPremium(){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $request=request();
        // dd($request);
        $reports=[];
        $reports['total']=Tutor::where('is_premium',1)->get()->count();
        $reports['todays']=Tutor::where('is_premium',1)->whereDate('premium_started_at',Carbon::now())->get()->count();
        $reports['tuiton_received']=Tutor::whereHas('job_applications',function($q){
            return $q->where('current_stage','payment');
        })->get()->count();
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());

		$q=$request->q;
		$limit=$request->limit;
		$city=$request->city;
		$location=$request->location;
		$is_verified=$request->is_verified;
		$is_featured=$request->is_featured;

		$page_title="All Tutors";
		
		if($limit==null){
			$limit=10;
        }
        $query= Tutor::where('is_premium',1)->latest();
        if($q!=null){
            $query= Tutor::select("tutors.*")->join('users','users.id','tutors.user_id');
			$query=$query->where('tutors.tutor_id','like','%'.$q.'%')
						 ->orWhere('users.name','like','%'.$q.'%')
						 ->orWhere('users.email','like','%'.$q.'%')
						 ->orWhere('users.phone','like','%'.$q.'%');
		}
        if($request->from!=null && $request->to!=null){
            $query= $query->whereBetween('created_at',[$request->from,$request->to]);
        }else{
            if($request->from!=null){
                $query= $query->whereBetween('created_at',[$request->from,now()]);
            }
        }
        if($preferred_location_id= $request->preferred_location_id){
            $query=$query->whereHas('pref_locations',function($q)use($preferred_location_id){
                return $q->where('location_id',$preferred_location_id);
            });
        }
        if($category_id= $request->category_id){
            $query=$query->whereHas('categories',function($q) use($request){
                return $q->where('category_id',$request->category_id);
            });
        }
        if($channel= $request->channel){
            $query=$query->whereHas('user',function($q) use($request){
                return $q->where('channel',$request->channel);
            });
        }
        $query = $query->whereHas('tutor_personal_information',function($q) use($request){
            if($city_id= $request->city_id){
                $q=$q->where('city_id',$city_id);
            }
            if($location_id= $request->location_id){
                $q=$q->where('location_id',$location_id);
            }
            if($tutor_gender= $request->tutor_gender){
                $q=$q->where('gender',$tutor_gender);
            }
            return $q;
        });
        if($request->year!=null || $request->university_type!=null || $request->study_type_id!=null || $request->institute_id!=null || $request->tutor_department!=null){
            $query = $query->whereHas('tutor_degrees',function($q) use($request){
                if($year= $request->year){
                    $q=$q->where('year_or_semester',$year);
                }
                if($university_type= $request->university_type){
                    $q=$q->where('university_type',$university_type);
                }
                if($study_type_id= $request->study_type_id){
                    $q=$q->where('study_type_id',$study_type_id);
                }
                if($institute_id= $request->institute_id){
                    $q=$q->where('institute_id',$institute_id);
                }
                if($tutor_department= $request->tutor_department){
                    $q=$q->where('department',$tutor_department);
                }
            });
        }
        // dd($query);
        $tutors=$query->paginate($limit);
        // dd($tutors);
		return view('admin.tutor.premium',\compact('reports','tutors','institutes','categories_collection','city_collection','request','page_title'));
	}
	public function getFeatured(){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $request=request();
        // dd($request);
        $reports=[];
        $reports['total']=Tutor::all()->count();
        $reports['premium']=Tutor::where('is_premium',1)->get()->count();
        $reports['featured']=Tutor::where('is_featured',1)->get()->count();
        $reports['male']=Tutor::whereHas('tutor_personal_information',function($q){
            return $q->where('gender','male');
        })->get()->count();
        $reports['female']=Tutor::whereHas('tutor_personal_information',function($q){
            return $q->where('gender','female');
        })->get()->count();
        $categories=Category::all();
        $courses=Course::all();
        $institutes=Institute::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection($courses);
        $city_collection=CityResource::collection(City::all());

		$q=$request->q;
		$limit=$request->limit;
		$city=$request->city;
		$location=$request->location;
		$is_verified=$request->is_verified;
		$is_featured=$request->is_featured;

		$page_title="All Tutors";
		
		if($limit==null){
			$limit=10;
        }
        $query= Tutor::where('is_featured',1)->latest();
        if($q!=null){
            $query= Tutor::select("tutors.*")->join('users','users.id','tutors.user_id');
			$query=$query->where('tutors.tutor_id','like','%'.$q.'%')
						 ->orWhere('users.name','like','%'.$q.'%')
						 ->orWhere('users.email','like','%'.$q.'%')
						 ->orWhere('users.phone','like','%'.$q.'%');
		}
        if($request->from!=null && $request->to!=null){
            $query= $query->whereBetween('created_at',[$request->from,$request->to]);
        }else{
            if($request->from!=null){
                $query= $query->whereBetween('created_at',[$request->from,now()]);
            }
        }
        if($preferred_location_id= $request->preferred_location_id){
            $query=$query->whereHas('pref_locations',function($q)use($preferred_location_id){
                return $q->where('location_id',$preferred_location_id);
            });
        }
        if($category_id= $request->category_id){
            $query=$query->whereHas('categories',function($q) use($request){
                return $q->where('category_id',$request->category_id);
            });
        }
        if($channel= $request->channel){
            $query=$query->whereHas('user',function($q) use($request){
                return $q->where('channel',$request->channel);
            });
        }
        $query = $query->whereHas('tutor_personal_information',function($q) use($request){
            if($city_id= $request->city_id){
                $q=$q->where('city_id',$city_id);
            }
            if($location_id= $request->location_id){
                $q=$q->where('location_id',$location_id);
            }
            if($tutor_gender= $request->tutor_gender){
                $q=$q->where('gender',$tutor_gender);
            }
            return $q;
        });
        if($request->year!=null || $request->university_type!=null || $request->study_type_id!=null || $request->institute_id!=null || $request->tutor_department!=null){
            $query = $query->whereHas('tutor_degrees',function($q) use($request){
                if($year= $request->year){
                    $q=$q->where('year_or_semester',$year);
                }
                if($university_type= $request->university_type){
                    $q=$q->where('university_type',$university_type);
                }
                if($study_type_id= $request->study_type_id){
                    $q=$q->where('study_type_id',$study_type_id);
                }
                if($institute_id= $request->institute_id){
                    $q=$q->where('institute_id',$institute_id);
                }
                if($tutor_department= $request->tutor_department){
                    $q=$q->where('department',$tutor_department);
                }
            });
        }
        // dd($query);
        $tutors=$query->paginate($limit);
        // dd($tutors);
		return view('admin.tutor.featured',\compact('reports','tutors','institutes','categories_collection','city_collection','request','page_title'));
	}
	public function getSingle($id){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$tutor=Tutor::findOrFail($id);
        // dd($tutor->user);
		$page_title="Tutor Profile - ".$tutor->user->name;
		// dd($tutor);
		return view('admin.tutor.single',compact('tutor','page_title'));
	}
	public function getSinglePresentPending($id){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$tutor=Tutor::findOrFail($id);
        $page_title="Current Pending - ".$tutor->user->name;
        $pending_applications=$tutor->job_applications()->whereNotNull('taken_by_id')->whereIn('current_stage',['waiting','meet','trial'])->get();
        $payment_pending_applications=$tutor->job_applications()->whereNotNull('taken_by_id')->where('net_receivable_amount','>',DB::raw('received_amount'))->orWhereIn('current_stage',['confirm','payment'])->get();
		// dd($pending_applications);
		return view('admin.tutor.single_present_pending',compact('tutor','pending_applications','payment_pending_applications','page_title'));
	}
    
    public function getSingleHistory($id){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$tutor=Tutor::findOrFail($id);
        $page_title="Tutor History - ".$tutor->user->name;
        $applications=$tutor->job_applications;
        $given_applications=$tutor->job_applications()->whereNotNull('taken_by_id')->get();
        $confirm_applications=$tutor->job_applications()->whereNotNull('taken_by_id')->where('current_stage','confirm')->get();
        // dd($applications);
        $pending_applications=$tutor->job_applications()->whereNotNull('taken_by_id')->whereIn('current_stage',['waiting','meet','trial'])->get();
        $payment_pending_applications=$tutor->job_applications()->whereNotNull('taken_by_id')->where('net_receivable_amount','>',DB::raw('received_amount'))->orWhereIn('current_stage',['confirm','payment'])->get();
		// dd($pending_applications);
		return view('admin.tutor.single_history',compact('tutor','applications','given_applications','confirm_applications','pending_applications','payment_pending_applications','page_title'));
	}

	public function getNew(){
		$page_title="New Tutor";
		return view('admin.tutor.new',\compact('page_title'));
	}
	public function postNew(){
		$request=request();
		$request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:13|min:11',
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sms_otp' => rand(99999,999999),
            'cb_roles_id' => 3,
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
            'password' => Hash::make("Tuition123#"),
        ]);
        $tutor=Tutor::create([
            'user_id'  => $user->id
        ]);
        $tutor->save_tutor_id();
        TutorPersonalInformation::create([
            'tutor_id'  => $tutor->id
            // 'tutor_id'  => 1
		]);
		return redirect()->back()->with('success','New Tutor Account has been registered successfully');
    }
    public function import(){
        $file = fopen(public_path('tutors.csv'),'r');
        $i=0;
        $err_count=0;
        while (!feof($file)) {
            $line = fgetcsv($file);            
            if(++$i<=2){
                continue;
            }
            try{
                $user = User::create([
                    'name' => $line[0],
                    'email' => $line[3],
                    'phone' => $line[2],
                    'sms_otp' => rand(99999,999999),
                    'cb_roles_id' => 3,
                    'phone_verified_at' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make("Tuition123#"),
                    'channel' => 'System'
                ]);
                $tutor=Tutor::create([
                    'user_id'  => $user->id,
                    'location_id' => $this->location_id($line[10],$line[12]),
                    'city_id' => $this->city_id($line[12]),
                ]);
                $tutor->save_tutor_id();
                TutorPersonalInformation::create([
                    'tutor_id'  => $tutor->id,
                    'gender' => strtolower($line[1]),
                    'id_number' => $line[16],
                    'fathers_phone' => $line[15],
                    'emergency_phone' => $line[19],
                    'facebook_profile' => $line[18],
                    'location_id' => $this->location_id($line[10],$line[12]),
                    'city_id' => $this->city_id($line[12]),
                ]);
                $tutor->prefered_locations()->sync($this->prefered_location_ids($line[11],$line[12]));
                if(isset($line[14]) && $line[14]!=null){
                    $tutor->tutor_degrees()->create([
                        "degree_id" => 6,
                        "institute_id" => $this->institute_id($line[14]),
                        "group_or_major" => $line[5],
                        "curriculum_id" => $this->curriculum_id($line[4]),
                        ]);
                }
                if(isset($line[13]) && $line[13]!=null){
                    $tutor->tutor_degrees()->create([
                        "degree_id" => 5,
                        "institute_id" => $this->institute_id($line[13]),
                    ]);
                }
                if(isset($line[8]) && $line[8]!=null){
                    $tutor->tutor_degrees()->create([
                        "degree_id" => 4,
                        "institute_id" => $this->institute_id($line[8]),
                        'department' => $line[6],
                        'university_type' => $line[9],
                        'year_or_semester' => $line[7],
                    ]);
                }
            }catch(\Exception $e){
                $err_count+=1;
            }
            // if($i>9){
            //     break;
            // }
        }
        echo $err_count;
    }
	public function getEdit_info($id){
		$page_title="Edit Tutor Info";
        $tutor=Tutor::findOrFail($id);
        $categories=Category::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection(Course::all());
        $city_collection=CityResource::collection(City::all());
        // return $city_collection;
        // dd($tutor->course_subjects[0]);
        return view('admin.tutor.edit_info',\compact('tutor','categories','categories_collection','courses_collection','city_collection','page_title'));
	}
	public function postUpdate_ti(Request $request){
        $tutor = Tutor::findOrFail($request->tutor_id);
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

        return cb()->redirect(action('AdminTutorsController@getEdit_info',[$request->tutor_id])."?tab=ti",'Information Updated Successfully','success');
    }
    public function postUpdate_ei(Request $request){
        // dd($request);
        $tutor = Tutor::findOrFail($request->tutor_id);
        $ssc=$tutor->tutor_degrees()->where('degree_id',6)->first();
        $hsc=$tutor->tutor_degrees()->where('degree_id',5)->first();
        $bachelors=$tutor->tutor_degrees()->where('degree_id',4)->first();
        $masters=$tutor->tutor_degrees()->where('degree_id',3)->first();
        $isDiploma=$request->is_diploma_student;
        $parsonalData=$tutor->tutor_personal_information;
        if($isDiploma==null){
            $isDiploma=0;
        }
        $ssc_data=[
            "degree_id" => 6,
            "institute_id" => $this->institute_id($request->institute[6]),
            "curriculum_id" => $request->curriculum[6],
            "group_or_major" => $request->group_or_major[6],
            "passing_year" => $request->passing_year[6],
            "gpa" => $request->gpa[6],
            "education_board" => $request->education_board[6],
        ];
        if($isDiploma==0){
            $hsc_data=[
                "degree_id" => 5,
                "institute_id" => $this->institute_id($request->institute[5]),
                "curriculum_id" => $request->curriculum[5],
                "group_or_major" => $request->group_or_major[5],
                "passing_year" => $request->passing_year[5],
                "gpa" => $request->gpa[5],
                "education_board" => $request->education_board[5],
            ];
        }
        $bachelors_data=[
            "degree_id" => 4,
            "institute_id" => $this->institute_id($request->institute[4]),
            "gpa" => $request->gpa[4],
            "currently_studying" => $request->currently_studing[4],
            'study_type_id' => $request->study_type_id[4],
            'department' => $request->department[4],
            'university_type' => $request->university_type[4],
            'year_or_semester' => $request->year_or_semester[4],
        ];
        if($request->has_masters==1){
            $masters_data=[
                "degree_id" => 3,
                "institute_id" => $this->institute_id($request->institute[3]),
                "gpa" => $request->gpa[3],
                "currently_studying" => $request->currently_studing[3],
                'study_type_id' => $request->study_type_id[3],
                'department' => $request->department[3],
                'university_type' => $request->university_type[3],
                'year_or_semester' => $request->year_or_semester[3],
            ];
        }
        if($ssc!=null){
            $ssc->update($ssc_data);
        }else{
            $tutor->tutor_degrees()->create($ssc_data);
        }
        if($isDiploma==0){
            $parsonalData->is_diploma_student=0;
            $parsonalData->save();
            if($hsc!=null){
                $hsc->update($hsc_data);
            }else{
                $tutor->tutor_degrees()->create($hsc_data);
            }
        }else{
            $parsonalData->is_diploma_student=1;
            $parsonalData->save();
            if($hsc!=null){
                $hsc->delete();
            }
        }
        if($bachelors!=null){
            $bachelors->update($bachelors_data);
        }else{
            $tutor->tutor_degrees()->create($bachelors_data);
        }
        if($masters!=null){
            if($request->has_masters==null){
                $masters->delete();
            }else{
                $masters->update($masters_data);
            }
        }else{
            if($request->has_masters==1){
                $tutor->tutor_degrees()->create($masters_data);
            }
        }
        return cb()->redirect(action('AdminTutorsController@getEdit_info',[$request->tutor_id])."?tab=ei",'Information Updated Successfully','success');
    }
    public function postUpdate_pi(Request $request){
        // dd($request);
        $tutor = Tutor::findOrFail($request->tutor_id);
        $tutor->tutor_personal_information()->update([
        'city_id' => $request->city,
        'religion_id'=>$request->religion_id,
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

        return cb()->redirect(action('AdminTutorsController@getEdit_info',[$request->tutor_id])."?tab=pi",'Information Updated Successfully','success');
    }
    function postChangeActiveStatus(Request $request){
        $tutor=Tutor::findOrFail($request->id);
        $tutor->is_active=$request->is_active;
        $tutor->save();
        return "success";
    }
    function postMakePremium(Request $request){
        $tutor=Tutor::findOrFail($request->id);
        $tutor->is_premium=1;
        $tutor->premium_by=auth()->id();
        $tutor->premium_started_at=Carbon::now();
        $tutor->save();
        return cb()->redirectBack($tutor->user->name.' is added as premium tutor successfully','success');
    }
    function postMakeFeatured(Request $request){
        $tutor=Tutor::findOrFail($request->id);
        $tutor->is_featured=1;
        $tutor->save();
        return cb()->redirectBack($tutor->user->name.' is marked as featured tutor successfully','success');
    }
    function postMakeVerify(Request $request){
        $tutor=Tutor::findOrFail($request->id);
        $tutor->is_verified=1;
        $tutor->save();
        return cb()->redirectBack($tutor->user->name.' is marked as verified tutor successfully','success');
    }
    function postSaveNote(Request $request){
        $tutor=Tutor::findOrFail($request->id);
        $tutor->notes()->save(new TutorNote([
            'user_id' => auth()->id(),
            'note'=>$request->note
        ]));
        return cb()->redirectBack('Note added successfully','success');
    }
}
