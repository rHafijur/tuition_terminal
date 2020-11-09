<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedTutorRequest extends Model
{
    protected $fillable=[
        'tutor_id',
        'payment_id',
        'status',
    ];

    public function tutor(){
        return $this->belongsTo("App\Tutor",'tutor_id');
    }
    public function payment(){
        return $this->belongsTo("App\Payment",'payment_id');
    }
}
