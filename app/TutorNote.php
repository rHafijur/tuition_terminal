<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorNote extends Model
{
    protected $fillable=['tutor_id','user_id','note'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function takenBy(){
        return $this->user;
    }
}
