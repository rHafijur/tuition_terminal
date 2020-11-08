<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumMembershipRequest extends Model
{
    protected $fillable=[
        'tutor_id',
        'payment_id',
        'status',
    ];
}
