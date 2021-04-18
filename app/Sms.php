<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Sms extends Model

{
    protected $fillable=['sent_by','user_id','body','phone'];

    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }
    public function sentBy(){
        return $this->belongsTo("App\User",'sent_by');
    }

    public static function smsApiRequest($numbers_string,$text){
        $cURLConnection = curl_init();
        $text=\urlencode($text);
        $url='https://easybulksmsbd.com/sms/api?action=send-sms&api_key=VHVpdGlvbiBUZXJtaW5hbDoxMjM0NTY3&to='.$numbers_string.'&from=SenderID&sms='.$text;
    //    dd($url);
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        return $res;
    }
    public static function otpApiRequest($numbers_string,$text){
        $cURLConnection = curl_init();
        $text=\urlencode($text);
        $url='https://easybulksmsbd.com/sms/api?action=send-sms&api_key=VHVpdGlvbiBUZXJtaW5hbCAoT1RQKTpSYWtpYkBAQA==&to='.$numbers_string.'&from=SenderID&sms='.$text;
        // dd($url);
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        return $res;
    }
    public static function sendSameSmsToAll($users,$text){
        $numbers=[];
        $auth_id=auth()->id();
        foreach($users as $user){
            $numbers[]="88".$user->phone;
        }
        $numbers=implode(',',$numbers);
        $res= self::smsApiRequest($numbers,$text);
        // dd($res);
        foreach($users as $user){
            self::create([
                'sent_by'=>$auth_id,
                'user_id'=>$user->id,
                'phone'=>$user->phone,
                'body'=>$text,
            ]);
        }
        return $res;
    }
}
