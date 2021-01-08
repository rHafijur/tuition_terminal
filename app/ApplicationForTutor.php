<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationForTutor extends Model
{
    protected $fillable=[
        'tutor_id',
        'job_offer_id',
    ];
    public function tutor(){
        return $this->belongsTo("App\Tutor",'tutor_id');
    }
    public function job_offer_id(){
        return $this->belongsTo("App\Tutor",'job_offer_id');
    }
}
