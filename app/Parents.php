<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }
    public function job_offers(){
        return $this->hasMany("App\JobOffer",'parent_id');
    }
}
