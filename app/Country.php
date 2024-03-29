<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'name',
        'flag',
    ];

    public function country(){
        return $this->belongsTo("App\country",'country_id');
    }
}
