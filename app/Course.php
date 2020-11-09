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
        return $this->hasMany("App\Subject",'course_id');
    }
    public function category(){
        return $this->belongsTo("App\Category",'category_id');
    }
    public function course_subjects(){
        return $this->hasMany("App\CourseSubject",'course_id');
    }
}
