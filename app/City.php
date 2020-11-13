<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'country_id',
        'name',
    ];
    public function locations(){
        return $this->hasMany('App\Location');
    }
}
