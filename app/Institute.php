<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'title',
    ];
}
