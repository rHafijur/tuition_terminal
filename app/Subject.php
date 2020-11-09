<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'course_id',
        'title',
    ];

    public function course_subjects(){
        return $this->hasMany("App\CourseSubject",'subject_id');
    }
    public function course(){
        return $this->belongsTo("App\Course",'course_id');
    }
}
