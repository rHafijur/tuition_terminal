<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachingMethod extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'title',
    ];

    public function tutors(){
        return $this->belongsToMany("App\Tutor",'teaching_method_tutor','teaching_method_id','tutor_id');
    }
}
