<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tutor;
use App\JobApplication;
class JobOffer extends Model
{
    protected $fillable=[
        'parent_id',
        'category_id',
        'course_id',
        'city_id',
        'location_id',
        'name',
        'phone',
        'address',
        'days_in_week',
        'time',
        'min_salary',
        'max_salary',
        'student_gender',
        'tutor_gender',
        'name_of_institute',
        'number_of_students',
        'requirements',
        'hiring_from',
        'status',
        'is_active',
        'teaching_method_id',
        'tutor_study_type_id',
        'tutor_religion_id',
        'tutor_university_id',
        'tutor_school_id',
        'tutor_college_id',
        'tutor_category_id',
        'taken_by_1_id',
        'taken_by_2_id',
        'university_type',
        'group',
        'reference_name',
        'reference_contact',
        'reference_city_id',
        'email',
        'additional_contact',
        'source',
        'spicial_note',
        'tutor_department',
        'board',
        'year_or_semester',
        'curriculum_id',
    ];
    public function parents(){
        return $this->belongsTo("App\Parents",'parent_id');
    }
    public function city(){
        return $this->belongsTo("App\City",'city_id');
    }
    public function reference_city(){
        return $this->belongsTo("App\City",'reference_city_id');
    }
    public function location(){
        return $this->belongsTo("App\Location",'location_id');
    }
    public function category(){
        return $this->belongsTo("App\Category",'category_id');
    }
    public function course(){
        return $this->belongsTo("App\Course",'course_id');
    }
    public function tutor_study_type(){
        return $this->belongsTo("App\StudyType",'tutor_study_type_id');
    }
    public function tutor_study_types(){
        return $this->belongsToMany("App\StudyType",'job_offer_study_type','job_offer_id','study_type_id');
    }
    public function tutor_departments(){
        return $this->belongsToMany("App\Department",'job_offer_department','job_offer_id','department_id');
    }
    public function tutor_religion(){
        return $this->belongsTo("App\Religion",'tutor_religion_id');
    }
    public function tutor_university(){
        return $this->belongsTo("App\Institute",'tutor_university_id');
    }
    public function tutor_universities(){
        return $this->belongsToMany("App\Institute",'job_offer_university','job_offer_id','institute_id');
    }
    public function tutor_school(){
        return $this->belongsTo("App\Institute",'tutor_school_id');
    }
    public function tutor_college(){
        return $this->belongsTo("App\Institute",'tutor_college_id');
    }
    public function tutor_category(){
        return $this->belongsTo("App\Category",'tutor_category_id');
    }
    public function em1(){
        return $this->belongsTo("App\User",'taken_by_1_id');
    }
    public function em2(){
        return $this->belongsTo("App\User",'taken_by_2_id');
    }
    public function applications(){
        return $this->hasMany('App\JobApplication','job_offer_id');
    }
    public function tutor_applications(){
        return $this->hasMany('App\ApplicationForTutor','job_offer_id');
    }
    public function course_subjects(){
        return $this->belongsToMany("App\CourseSubject",'course_subject_job_offer','job_offer_id','course_subject_id');
    }
    public function teaching_method(){
        return $this->belongsTo("App\TeachingMethod",'teaching_method_id');
    }
    public function isActive(){
        if($this->is_active==1){
            return 'Yes';
        }
        return 'No';
    }
    public function getStatus(){
        if($this->status== -1){
            return 'Pending';
        }else if($this->status== 0){
            return 'Canceled';
        }
        return 'Approved';
    }
    public function already_applied(){
        $app = $this->applications()->where('tutor_id',auth()->user()->tutor->id)->first();
        if($app!=null){
            return true;
        }
        return false;
    }
    public function already_applied_for_tutor($id){
        $app = $this->tutor_applications()->where('tutor_id',$id)->first();
        if($app==null){
            return true;
        }
        return false;
    }
    public function search_tutors_by_matching(){
        $t=microtime(true);
        // $tutors=Tutor::with(['tutor_personal_information','courses','prefered_locations','categories','course_subjects','tutor_degrees'=>function($q){
        //     return $q->whereIn('degree_id',[3,4]);
        // }])->get();
        $offer=$this;
        $tutors=Tutor::orderBy('is_premium','desc');
        $tutors=$tutors->whereHas('city',function($q){
            return $q->where('id',$this->city_id);
        });
        $tutors=$tutors->whereHas('pref_locations',function($q){
            return $q->where('location_id',$this->location_id);
        });
        if($offer->tutor_gender!=null || $offer->tutor_religion_id!=null){
            $tutors=$tutors->whereHas('tutor_personal_information',function($q){
                if($this->tutor_gender!=null && $this->tutor_religion_id!=null){
                    return $q->where('gender',$this->tutor_gender)->where('religion_id',$this->tutor_religion_id);
                }elseif($this->tutor_gender!=null){
                    return $q->where('gender',$this->tutor_gender);
                }else{
                    return $q->where('religion_id',$this->tutor_religion_id);
                }
            });
        }
        if($offer->category_id=!null){
            $tutors=$tutors->whereHas('categories',function($q){
                return $q->where('id',$this->category_id);
            });
        }

        $tutors= $tutors->whereHas('tutor_degrees',function($q){
            if($this->group!=null){
                $q=$q->where(function($q){
                    return $q->where('degree_id',6)->where('group_or_major','like',"%".$this->group."%");
                });
            }
            if($this->tutor_school_id!=null){
                $q=$q->where(function($q){
                    return $q->where('degree_id',6)->where('institute_id',$this->tutor_school_id);
                });
            }
            if($this->curriculum_id!=null){
                $q=$q->where(function($q){
                    return $q->where('degree_id',6)->where('curriculum_id',$this->curriculum_id);
                });
            }
            if($this->tutor_college_id!=null){
                $q=$q->where(function($q){
                    return $q->where('degree_id',5)->where('institute_id',$this->tutor_college_id);
                });
            }
            if($this->tutor_departments->count()>0){
                $q=$q->where(function($q){
                    $ids=[];
                    foreach($this->tutor_departments as $td){
                        $ids[]=$td->id;
                    }
                    return $q->where('degree_id',4)->whereIn('institute_id',$ids);
                });
            }
            if($this->tutor_universities->count()>0){
                $q=$q->where(function($q){
                    $ids=[];
                    foreach($this->tutor_universities as $tu){
                        $ids[]=$tu->id;
                    }
                    return $q->where('degree_id',4)->whereIn('institute_id',$ids);
                });
            }
            if($this->university_type!=null){
                $q=$q->where(function($q){
                    return $q->where('degree_id',4)->where('university_type',$this->university_type);
                });
            }
        });
        // $tutors=Tutor::with(['pref_locations','courses','course_subjects'])->limit(500)->get();
        // $tutors=Tutor::with(['course_subjects'])->remember(60)->get();
        $tutors=$tutors->with(['courses','course_subjects','teaching_methods'])->get();
        // dd($tutors);
        // dd(microtime(true)-$t);
        $applications=$this->applications;
        $offer_cat=$offer->category;
        $offer_course_subjects=$offer->course_subjects;
        $tutor_array=[];
        foreach($tutors as $tutor){
            $parcent=0;
            // $personal=$tutor->tutor_personal_information;
            // $u_degrees=$tutor->tutor_degrees()->whereIn('degree_id',[3,4])->get();
            // $u_degrees=$tutor->tutor_degrees;
            $cat_matched=false;
            $gender_matched=false;
            $university_matched=false;
            $city_matched=false;
            $department_matched=false;
            $study_type_matched=false;
            $university_type_matched=false;

            // foreach($tutor->categories as $category){
            //     if($offer_cat->id==$category->id){
            //         $cat_matched=true;
            //         break;
            //     }
            // }

            // if($personal!=null && $personal->gender==$offer->tutor_gender){
            //     $gender_matched=true;
            // }

            // foreach($u_degrees as $degree){
            //     if($degree->institute_id==$offer->tutor_university_id){
            //         $university_matched=true;
            //         break;
            //     }
            //     if($degree->university_type==$offer->university_type){
            //         $university_type_matched=true;
            //     }
            //     if($degree->study_type_id==$offer->tutor_study_type_id){
            //         $study_type_matched=true;
            //     }
            //     if($degree->department==$offer->tutor_department){
            //         $department_matched=true;
            //     }
            // }


            // if($tutor->city_id==$offer->city_id){
            //     $city_matched=true;
            // }
            // if($offer->tutor_department==null){
            //     $department_matched=true;
            // }
            // if($offer->tutor_study_type_id==null){
            //     $study_type_matched=true;
            // }
            // if($offer->university_type==null){
            //     $university_type_matched=true;
            // }
            // if($cat_matched && $gender_matched && $university_matched && $city_matched && $department_matched && $study_type_matched && $university_type_matched){
            //     $parcent+=50;
            // }


            // if($offer->location_id==$tutor->location_id){
            //     $parcent+=20;
            // }
            
            
            
            // foreach($tutor->pref_locations as $pref_loc){
            //     if($offer->location_id==$pref_loc->location_id){
            //         $parcent+=20;
            //         break;
            //     }
            // }

            //Parcent for location;
            $parcent+=20;
            foreach($tutor->courses as $cs){
                if($cs->id==$offer->course_id){
                    $parcent+=45;
                }
            }
            $ocs=$offer_course_subjects;
            $ocs_count=$ocs->count();
            $ocs_match_found=0;
            $tcs= $tutor->course_subjects;
            foreach($ocs as $oc){
                foreach($tcs as $tc){
                    if($oc->pivot->course_subject_id==$tc->pivot->course_subject_id){
                        $ocs_match_found+=1;
                        break;
                    }
                }
            }
            $ocs_percent=($ocs_match_found / $ocs_count) * 100;
            $parcent+= (25/100) * $ocs_percent;
            // if($personal!=null && $personal->gender==$offer->student_gender){
            //     $parcent+=5;
            // }
            if($tutor->tutoring_experience!=null){
                $parcent+=8;
            }
            foreach($tutor->teaching_methods as $tm){
                if($this->teaching_method_id==$tm->id){
                    $parcent+=2;
                    break;
                }
            }
            // if($parcent>=50){
                
            // }
            $tutor->mathcing_rate=$parcent;
            foreach($applications as $app){
                if($app->tutor_id=$tutor->id){
                    $tutor->applied=true;
                    break;
                }
            }
            $tutor_array[]=$tutor;
        }
        $tutor_count=count($tutor_array);
        // \dump($tutor_count);
        // dd(microtime(true)-$t);
        for($i=0;$i<$tutor_count;$i++){
            for($j=$i+1; $j < $tutor_count;$j++){
                if($tutor_array[$i]->mathcing_rate < $tutor_array[$j]->mathcing_rate){
                    $temp=$tutor_array[$i];
                    $tutor_array[$i]=$tutor_array[$j];
                    $tutor_array[$j]=$temp;
                }
            }
        }
        $premium_tutors=[];
        $tutors=[];
        foreach($tutor_array as $tutor){
            if($tutor->is_premium==1){
                $premium_tutors[]=$tutor;
            }else{
                $tutors[]=$tutor;
            }
        }
        return array_merge($premium_tutors,$tutors);
    }
}
