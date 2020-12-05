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
    public function seen(){
        $this->is_seen=1;
        $this->save();
    }
}
