<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'city_id',
        'name',
    ];
}
