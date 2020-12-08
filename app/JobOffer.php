<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    ];
    public function parents(){
        return $this->belongsTo("App\Parents",'parent_id');
    }
    public function city(){
        return $this->belongsTo("App\City",'city_id');
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
    public function applications(){
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
}
