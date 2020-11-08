<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'tutor_degree_id',
        'file_path',
    ];
}
