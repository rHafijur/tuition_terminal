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
        'group',
        'passing_year',
        'currently_studying',
    ];
}
