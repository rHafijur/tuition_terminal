<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'title',
    ];
}
