<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
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
    public function course_subjects(){
        return $this->belongsToMany("App\CourseSubject",'course_subject_job_offer','job_offer_id','course_subject_id');
    }
}
