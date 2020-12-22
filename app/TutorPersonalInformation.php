<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorPersonalInformation extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'tutor_id',
        'city_id',
        'location_id',
        'gender',
        'additional_phone',
        'full_address',
        'id_number',
        'nationality',
        'facebook_profile',
        'blood_group',
        'date_of_birth',
        'fathers_name',
        'mothers_name',
        'fathers_phone',
        'mothers_phone',
        'emergency_name',
        'emergency_phone',
        'short_description',
        'reasones_to_get_hired',
        'overview',
    ];
    protected $touches = ['tutor'];
    
    public function tutor(){
        return $this->belongsTo("App\Tutor",'tutor_id');
    }
    public function city(){
        return $this->belongsTo("App\City",'city_id');
    }
    public function location(){
        return $this->belongsTo("App\Location",'location_id');
    }
}
