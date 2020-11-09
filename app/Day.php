<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'title',
    ];

    public function tutors(){
        return $this->belongsToMany("App\Tutor",'day_tutor','day_id','tutor_id');
    }
}
