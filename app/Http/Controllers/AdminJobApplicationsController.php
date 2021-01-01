<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Http\Request;

use App\JobApplication;

class AdminJobApplicationsController extends CBController {


    public function cbInit()
    {
        $this->setTable("job_applications");
        $this->setPermalink("taken_offers");
        $this->setPageTitle("Taken Offers");
	}
	public function getIndex(){
		$page_title="Taken Offers";
		$stage="";
		$applications=JobApplication::whereNull('current_stage')->get();
		// dd($applications);
		return view('admin.taken_offers.dashboard',\compact('stage','page_title','applications'));
	}
	public function postSetWaiting(Request $request){
		$app=JobApplication::findOrFail($request->id);
		$app->waiting_stage=now();
		$app->waiting_date=$request->waiting_date;
		$app->current_stage="waiting";
		$app->save();
		return cb()->redirectBack('Application stage successfully changed to waiting','success');
	}
	public function postSetMeeting(Request $request){
		$app=JobApplication::findOrFail($request->id);
		$app->meeting_stage=now();
		$app->meeting_date=$request->meeting_date;
		$app->current_stage="meet";
		$app->save();
		return cb()->redirectBack('Application stage successfully changed to meeting','success');
	}
	public function postSetTrial(Request $request){
		$app=JobApplication::findOrFail($request->id);
		$app->trial_stage=now();
		$app->trial_date=$request->trial_date;
		$app->current_stage="trial";
		$app->save();
		return cb()->redirectBack('Application stage successfully changed to trial','success');
	}
	public function postSetRepost(Request $request){
		$app=JobApplication::findOrFail($request->id);
		$app->repost_date=now();
		$app->repost_note=$request->repost_note;
		$app->current_stage="repost";
		$app->save();
		return cb()->redirectBack('Application stage successfully changed to repost','success');
	}
	public function postSetCancel(Request $request){
		$app=JobApplication::findOrFail($request->id);
		$app->cancel_stage=now();
		$app->cancel_note=$request->cancel_note;
		$app->current_stage="cancel";
		$app->save();
		return cb()->redirectBack('Application stage successfully changed to cancel','success');
	}
	public function postSetConfirm(Request $request){
		$app=JobApplication::findOrFail($request->id);
		$app->confirm_stage=now();
		$app->confirm_date=$request->confirm_date;
		$app->payment_date=$request->payment_date;
		$app->tuition_salary=$request->tuition_salary;
		$app->commission=$request->commission;
		$app->receivable_amount=$request->receivable_amount;
		$app->net_receivable_amount=$request->net_receivable_amount;
		$app->current_stage="confirm";
		$app->save();
		return cb()->redirectBack('Application stage successfully changed to confirm','success');
	}
}
