<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachingType extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'title',
    ];

    public function tutors(){
        return $this->belongsToMany("App\Tutor",'teaching_type_tutor','teaching_type_id','tutor_id');
    }
}
