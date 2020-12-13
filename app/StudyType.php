<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyType extends Model
{
    public $timestamps = false;
    protected $fillable=['title'];
}
