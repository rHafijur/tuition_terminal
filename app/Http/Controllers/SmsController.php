<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;
use App\Sms;

class SmsController extends Controller
{
    public function sms_editor(Request $request){
        return redirect()->route('sms_editor_page',['ids'=>Crypt::encryptString($request->ids)]);
	}
    public function sms_editor_page($ids){
        $tids=Crypt::decryptString($ids);
        $ids=\json_decode($tids);
        $users = User::whereIn('id',$ids)->get();
        $page_title="SmS Editor";
		// dd($users);
        return view('admin.sms.editor',compact('page_title','users','tids'));
	}
    public function send_sms(Request $request){
        $ids=\json_decode($request->ids);
        $users = User::whereIn('id',$ids)->get();
        // dd($users);
        Sms::sendSameSmsToAll($users,$request->body);
        return cb()->redirectBack('SMS has been sent Successfully','success');
    }
}
