<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorDegree extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'tutor_id',
        'institute_id',
        'curriculum_id',
        'degree_id',
        'gpa',
        'education_board',
        'group_or_major',
        'passing_year',
        'currently_studying',
        'id_no',
        'degree_title',
        'degree_title',
    ];

    public function tutor(){
        return $this->belongsTo("App\Tutor",'tutor_id');
    }
    public function institute(){
        return $this->belongsTo("App\Institute",'institute_id');
    }
    public function curriculum(){
        return $this->belongsTo("App\Curriculum",'curriculum_id');
    }
    public function degree(){
        return $this->belongsTo("App\Degree",'degree_id');
    }
    public function certificates(){
        return $this->hasMany("App\Certificate",'tutor_degree_id');
    }
}
