<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable=[
        'job_offer_id',
        'tutor_id',
        'taken_by_id',
        'taken_at',
        'waiting_stage',
        'waiting_date',
        'meeting_stage',
        'meeting_date',
        'trial_stage',
        'trial_date',
        'confirm_stage',
        'confirm_date',
        'payment_date',
        'cancel_stage',
        'cancel_note',
        'repost_date',
        'repost_note',
        'note',
        'tuition_salary',
        'commission',
        'receivable_amount',
        'net_receivable_amount',
        'is_reposted',
        'is_canceled',
        'is_taken',
        'is_seen',
    ];
    
    public function job_offer(){
        return $this->belongsTo('App\JobOffer','job_offer_id');
    }
    public function tutor(){
        return $this->belongsTo('App\Tutor','tutor_id');
    }
    public function taken_by(){
        return $this->belongsTo('App\User','taken_by_id');
    }
}
