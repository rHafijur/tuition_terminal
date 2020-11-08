<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'course_id',
        'title',
    ];
}
