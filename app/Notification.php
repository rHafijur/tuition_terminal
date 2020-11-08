<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable=[
        'user_id',
        'subject',
        'link',
        'details',
        'is_seen',
    ];
}
