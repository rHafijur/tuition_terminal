<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    public $timestamps = false;
    
    protected $fillable=['title'];
}
