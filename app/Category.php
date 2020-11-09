<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'title',
    ];

    public function courses(){
        return $this->hasMany("App\Course",'category_id');
    }
    public function tutors(){
        return $this->belongsToMany("App\Tutor",'category_tutor','category_id','tutor_id');
    }
}
