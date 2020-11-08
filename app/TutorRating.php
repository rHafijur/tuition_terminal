<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorRating extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'tutor_id',
        'rating',
        'user_id',
        'source',
    ];
}
