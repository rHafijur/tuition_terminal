<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'tutor_id',
        'type',
        'file_path',
    ];
}
