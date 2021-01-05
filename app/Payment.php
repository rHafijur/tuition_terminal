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
        'confirmed',
        'payment_for',
        'due_amount',
        'receivable_amount',
        'due_date',
        'is_turned_off',
        'turned_off_amount',
    ];

    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }
    public function verified_tutor_request(){
        return $this->hasOne('App\VerifiedTutorRequest');
    }
    public function featured_tutor_request(){
        return $this->hasOne('App\FeaturedTutorRequest');
    }
    public function premium_tutor_request(){
        return $this->hasOne('App\PremiumMembershipRequest');
    }
    // public function payment_for(){
    //     if($this->verified_tutor_request!==null){
    //         return "Verified Tutor";
    //     }elseif($this->featured_tutor_request!==null){
    //         return "Featured Tutor";
    //     }elseif($this->premium_tutor_request!==null){
    //         return "Premium Tutor";
    //     }else{
    //         return "Unknown";
    //     }
    // }
}
