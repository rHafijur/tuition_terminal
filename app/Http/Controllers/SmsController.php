<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;
use App\JobOffer;
use App\SmsTemplate;
use App\Sms;

class SmsController extends Controller
{
    public function sms_editor(Request $request){
        // dd($request);
        if($request->job_id){
            return redirect(route('sms_editor_page',['ids'=>Crypt::encryptString($request->ids)])."?job_id=".$request->job_id); 
        }
        return redirect()->route('sms_editor_page',['ids'=>Crypt::encryptString($request->ids)]);
	}
    public function sms_editor_page($ids){
        $tids=Crypt::decryptString($ids);
        $ids=\json_decode($tids);
        $users = User::whereIn('id',$ids)->get();
        $page_title="SmS Editor";
        $sms_templates=SmsTemplate::orderBy('title')->get();
        $offer=null;
        if(request()->job_id){
            $offer=JobOffer::find(request()->job_id);
        }
		// dd($users);
        return view('admin.sms.editor',compact('page_title','users','tids','offer','sms_templates'));
	}
    public function send_sms(Request $request){
        $ids=\json_decode($request->ids);
        $users = User::whereIn('id',$ids)->get();
        Sms::sendSameSmsToAll($users,$request->body);
        // dd($users->chunk(100));
        // $ch=$users->chunk(10);
        // $len=count($ch);
        // $i=1;
        // foreach($ch as $us){
        //     Sms::sendSameSmsToAll($us,$request->body);
        //     echo ($i*10)."/".$len."<br>";
        //     $i++;
        //     break;
        // }
        return cb()->redirectBack('SMS has been sent Successfully','success');
    }
}
