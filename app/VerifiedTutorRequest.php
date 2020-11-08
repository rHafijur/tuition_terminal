<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifiedTutorRequest extends Model
{
    protected $fillable=[
        'tutor_id',
        'payment_id',
        'status',
    ];
}
