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
    public function tutor_religion(){
        return $this->belongsTo("App\Religion",'tutor_religion_id');
    }
    public function tutor_university(){
        return $this->belongsTo("App\Institute",'tutor_university_id');
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
