<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'course_id',
        'subject_id',
    ];
    public function course(){
        return $this->belongsTo("App\Course",'course_id');
    }
    public function subject(){
        return $this->belongsTo("App\Subject",'subject_id');
    }
    public function tutors(){
        return $this->belongsToMany("App\Tutor",'course_subject_tutor','course_subject_id','tutor_id');
    }
}
