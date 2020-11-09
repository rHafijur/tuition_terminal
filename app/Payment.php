<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=[
        'user_id',
        'method',
        'sent_from',
        'sent_to',
        'transaction_id',
        'amount',
        'note',
    ];

    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }
}
