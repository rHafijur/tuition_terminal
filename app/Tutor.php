<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable=[
        'user_id',
        'city_id',
        'location_id',
        'expected_salary',
        'tutoring_experience',
        'tutoring_experience_details',
        'is_verified',
        'is_featured',
        'is_premium',
        'premium_started_at',
    ];
}
