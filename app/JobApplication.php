<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable=[
        'job_offer_id',
        'tutor_id',
        'taken_by_id',
        'taken_at',
        'waiting_stage',
        'waiting_date',
        'meeting_stage',
        'meeting_date',
        'trial_stage',
        'trial_date',
        'confirm_stage',
        'confirm_date',
        'payment_date',
        'cancel_stage',
        'cancel_note',
        'repost_date',
        'repost_note',
        'note',
        'tuition_salary',
        'commission',
        'receivable_amount',
        'net_receivable_amount',
        'is_reposted',
        'is_canceled',
        'is_taken',
        'is_seen',
        'current_stage',
    ];
    
    public function job_offer(){
        return $this->belongsTo('App\JobOffer','job_offer_id');
    }
    public function tutor(){
        return $this->belongsTo('App\Tutor','tutor_id');
    }
    public function taken_by(){
        return $this->belongsTo('App\User','taken_by_id');
    }
    public function matched_rate(){
        $parcent=0;
        $tutor=$this->tutor;
        $personal=$tutor->tutor_personal_information;
        $u_degrees=$tutor->tutor_degrees()->whereIn('degree_id',[3,4])->get();
        $offer=$this->job_offer;
        $offer_cat=$offer->category;
        $cat_matched=false;
        $gender_matched=false;
        $university_matched=false;
        $city_matched=false;
        $department_matched=false;
        $study_type_matched=false;
        $university_type_matched=false;
        foreach($tutor->categories as $category){
            if($offer_cat->id==$category->id){
                $cat_matched=true;
                break;
            }
        }
        if($personal->gender==$offer->tutor_gender){
            $gender_matched=true;
        }
        foreach($u_degrees as $degree){
            if($degree->institute_id==$offer->tutor_university_id){
                $university_matched=true;
                break;
            }
        }
        if($tutor->city_id==$offer->city_id){
            $city_matched=true;
        }
        foreach($u_degrees as $degree){
            if($degree->department==$offer->tutor_department){
                $department_matched=true;
            }
        }
        if($offer->tutor_department==null){
            $department_matched=true;
        }
        foreach($u_degrees as $degree){
            if($degree->study_type_id==$offer->tutor_study_type_id){
                $study_type_matched=true;
            }
        }
        if($offer->tutor_study_type_id==null){
            $study_type_matched=true;
        }
        foreach($u_degrees as $degree){
            if($degree->university_type==$offer->university_type){
                $university_type_matched=true;
            }
        }
        if($offer->university_type==null){
            $university_type_matched=true;
        }
        if($cat_matched && $gender_matched && $university_matched && $city_matched && $department_matched && $study_type_matched && $university_type_matched){
            $parcent+=50;
        }
        if($offer->location_id==$tutor->location_id){
            $parcent+=20;
        }
        foreach($tutor->prefered_locations as $pref_loc){
            if($offer->location_id==$pref_loc->id){
                $parcent+=15;
                break;
            }
        }
        foreach($tutor->courses as $cs){
            if($cs->id==$offer->course_id){
                $parcent+=5;
            }
        }
        $ocs=$offer->course_subjects;
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
        $parcent+= (5/100) * $ocs_percent;
        if($personal->gender==$offer->student_gender){
            $parcent+=5;
        }
        return $parcent;
    }
}
