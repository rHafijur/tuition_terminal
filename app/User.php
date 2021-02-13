<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notification;
use App\Sms;

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
        'channel',
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

    public function notifications(){
        return $this->hasMany("App\Notification",'user_id');
    }
    public function payments(){
        return $this->hasMany("App\Payment",'user_id');
    }
    public function tutor(){
        return $this->hasOne("App\Tutor",'user_id');
    }
    public function parents(){
        return $this->hasOne("App\Parents",'user_id');
    }
    public function sendOtpSms(){
        $user=$this;
        // dd($phone);
        $user->sms_otp = rand(99999,999999);
        $user->save();
        $otp=$user->sms_otp;
        $response=Sms::otpApiRequest("88".$user->phone,$otp." is your OTP.\n Tuition Terminal");
        // $response = file_get_contents('http://easybulksmsbd.com/sms/api/v1',
        //     false, stream_context_create([
        //     'http' => [
        //     'method' => 'POST',
        //     'header' => 'Content-type: application/x-www-form-urlencoded',
        //     'content' => http_build_query([
        //     'mobile' => $phone, //use without +880
        //     'text' => $otp." is your OTP.\n Tuition Terminal",
        //     'email' => 'tuitionterminal24@gmail.com',
        //     'api' =>
        //     'ROracr8HxWAQvRisAoB3GZVJbvF20pJummI29g7jC6NEQCgH0wKXNngjdFrr'
        //     ])
        //     ]
        //     ]));
            return $response; //response data type is json
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
