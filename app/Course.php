<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'category_id',
        'title',
    ];

    public function subjects(){
        return $this->belongsToMany("App\Subject",'course_subjects','course_id','subject_id')->withPivot('id');
    }
    public function category(){
        return $this->belongsTo("App\Category",'category_id');
    }
    public function course_subjects(){
        return $this->hasMany("App\CourseSubject",'course_id');
    }
}
