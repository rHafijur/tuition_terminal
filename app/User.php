<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'sms_otp',
        'email_verified_at',
        'phone_verified_at',
        'photo',
        'cb_roles_id',
        'ip_address',
        'user_agent',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
         'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function notificatons(){
        return $this->hasMany("App\Notificaton",'user_id');
    }
    public function payments(){
        return $this->hasMany("App\Payment",'user_id');
    }
    public function tutor(){
        return $this->hasOne("App\Tutor",'user_id');
    }
    public function sendNotification($subject,$details,$link){
        Notification::create([
            'user_id' => $this->id,
            'subject' => $subject,
            'details' => $details,
            'link' => $link,
        ]);
    }
}
