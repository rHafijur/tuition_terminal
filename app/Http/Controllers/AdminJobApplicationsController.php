<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB as DB;

use App\JobApplication;
use App\Payment;

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
		$applications=JobApplication::whereNotNull('taken_by_id')->whereNull('current_stage')->get();
		// dd($applications);
		$waiting_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'waiting')->get()->count();
		$meeting_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'meet')->get()->count();
		$trial_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'trial')->get()->count();
		$confirm_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'confirm')->get()->count();
		$revenue=JobApplication::whereNotNull('taken_by_id')->sum('net_receivable_amount');
		// dd($waiting_cnt,$meeting_cnt,$trial_cnt,$confirm_cnt,$revenue);
		return view('admin.taken_offers.dashboard',\compact('stage','page_title','applications','waiting_cnt','meeting_cnt','trial_cnt','confirm_cnt','revenue'));
	}
	public function getWaiting(){
		$page_title="Taken Offers - Waiting";
		$stage="waiting";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','waiting')->get();
		// dd($applications);
		$waiting_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'waiting')->get()->count();
		$new_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'waiting')->whereDate('waiting_stage', Carbon::today())->get()->count();
		$today_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'waiting')->whereDate('waiting_date', Carbon::today())->get()->count();
		// dd($new_cnt,$today_cnt);
		return view('admin.taken_offers.waiting',\compact('stage','page_title','applications','waiting_cnt','new_cnt','today_cnt'));
	}
	public function getMeet(){
		$page_title="Taken Offers - Meeting";
		$stage="meet";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','meet')->get();
		// dd($applications);
		$meeting_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'meet')->get()->count();
		$new_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'meet')->whereDate('meeting_stage', Carbon::today())->get()->count();
		$today_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'meet')->whereDate('meeting_date', Carbon::today())->get()->count();
		// dd($new_cnt,$today_cnt);
		return view('admin.taken_offers.meeting',\compact('stage','page_title','applications','meeting_cnt','new_cnt','today_cnt'));
	}
	public function getTrial(){
		$page_title="Taken Offers - Trial";
		$stage="trial";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','trial')->get();
		// dd($applications);
		$trial_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'trial')->get()->count();
		$new_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'trial')->whereDate('trial_stage', Carbon::today())->get()->count();
		$today_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'trial')->whereDate('trial_date', Carbon::today())->get()->count();
		// dd($new_cnt,$today_cnt);
		return view('admin.taken_offers.trial',\compact('stage','page_title','applications','trial_cnt','new_cnt','today_cnt'));
	}
	public function getConfirm(){
		$page_title="Taken Offers - Confirm";
		$stage="confirm";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','confirm')->get();
		// dd($applications);
		$confirm_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'confirm')->get()->count();
		$new_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'confirm')->whereDate('confirm_stage', Carbon::today())->get()->count();
		$today_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'confirm')->whereDate('confirm_date', Carbon::today())->get()->count();
		$revenue=JobApplication::whereNotNull('taken_by_id')->sum('net_receivable_amount');
		// dd($new_cnt,$today_cnt);
		return view('admin.taken_offers.confirm',\compact('stage','page_title','applications','confirm_cnt','new_cnt','today_cnt','revenue'));
	}
	public function getDue(){
		$page_title="Taken Offers - Due";
		$stage="due";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','payment')->where('net_receivable_amount','>',DB::raw('received_amount'))->get();
		// dd($applications);
		$due_cnt=JobApplication::whereNotNull('taken_by_id')->where('current_stage','payment')->where('net_receivable_amount','>',DB::raw('received_amount'))->get()->count();
		$new_cnt=JobApplication::whereNotNull('taken_by_id')->where('current_stage','payment')->where('net_receivable_amount','>',DB::raw('received_amount'))->whereDate('confirm_stage', Carbon::today())->get()->count();
		$today_cnt=JobApplication::whereNotNull('taken_by_id')->where('current_stage','payment')->where('net_receivable_amount','>',DB::raw('received_amount'))->whereDate('due_date', Carbon::today())->get()->count();
		$revenue=JobApplication::whereNotNull('taken_by_id')->sum('net_receivable_amount');
		// dd($new_cnt,$today_cnt);
		return view('admin.taken_offers.due',\compact('stage','page_title','applications','due_cnt','new_cnt','today_cnt','revenue'));
	}
	public function getPayment(){
		$page_title="Taken Offers";
		$stage="payment";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','payment')->get();
		// dd($applications);
		$waiting_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'waiting')->get()->count();
		$meeting_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'meet')->get()->count();
		$trial_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'trial')->get()->count();
		$confirm_cnt=JobApplication::whereNotNull('taken_by_id')->where("current_stage",'confirm')->get()->count();
		$revenue=JobApplication::whereNotNull('taken_by_id')->sum('net_receivable_amount');
		// dd($waiting_cnt,$meeting_cnt,$trial_cnt,$confirm_cnt,$revenue);
		return view('admin.taken_offers.payment',\compact('stage','page_title','applications','waiting_cnt','meeting_cnt','trial_cnt','confirm_cnt','revenue'));
	}
	public function getRepost(){
		$page_title="Taken Offers - Repost";
		$stage="repost";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','repost')->get();
		return view('admin.taken_offers.repost',\compact('stage','page_title','applications'));
	}
	public function getCancel(){
		$page_title="Taken Offers - Cancel";
		$stage="cancel";
		$applications=JobApplication::whereNotNull('taken_by_id')->where('current_stage','cancel')->get();
		return view('admin.taken_offers.cancel',\compact('stage','page_title','applications'));
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
	public function getViewDatesAjax($id){
		$app=JobApplication::findOrFail($id);
		return view('admin.taken_offers.src.view_dates_ajax',compact('app'));
	}
	public function getPaymentFormAjax($id){
		$app=JobApplication::findOrFail($id);
		return view('admin.taken_offers.src.payment_form_ajax',compact('app'));
	}
	public function postSavePayment(){
		$request=request();
		if($request->is_turned_off==null){
			$request->is_turned_off=0;
		}
		$app=JobApplication::findOrFail($request->id);
		$app->received_amount= $app->received_amount + $request->received_amount;
		if($request->has_due==1){
			$app->due_date=$request->due_date;
			// $app->due_amount=$request->due_amount;
		}
		$app->is_payment_turned_off=$request->is_turned_off;
		$app->payment_turned_off_reason=$request->payment_turned_off_reason;
		$app->turned_off_amount=$request->payment_turned_off_amount;
		$app->reference_amount=$request->reference_amount;
		$app->current_stage="payment";
		$app->save();
		$user_id=$app->tutor->user_id;
		Payment::create([
			'user_id'=>$user_id,
			'confirmed'=>1,
			'payment_for'=>"Tuition Match",
			'method'=>$request->method,
			'sent_to'=>$request->sent_to,
			'amount'=>$request->received_amount,
			'due_amount'=>$request->due_amount,
			'receivable_amount'=>$app->net_receivable_amount,
			'due_date'=>$request->due_date,
			'is_turned_off'=>$request->is_turned_off,
			'turned_off_amount'=>$request->payment_turned_off_amount,
		]);
		return cb()->redirectBack('Application stage successfully changed to Payment','success');
	}
}
