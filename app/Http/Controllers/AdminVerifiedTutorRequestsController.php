<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

use App\VerifiedTutorRequest;

class AdminVerifiedTutorRequestsController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("verified_tutor_requests");
        $this->setPermalink("verified_tutor_requests");
        $this->setPageTitle("Verified Tutor Requests");

        $this->addText("Status","status")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
    public function getIndex(){
        if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $page_title="Verified Tutor Requests";
        $requests=VerifiedTutorRequest::orderBy('id','desc')->get();
        return view('admin.verified_tutor_request.all',\compact('requests','page_title'));
    }
    public function getGrant($id){
        $request = VerifiedTutorRequest::findOrFail($id);
        $tutor=$request->tutor;

        $tutor->user->sendNotification('Your Request for Verification has been accepted!','Congratulations! Your account is now verified',"#");

        $tutor->is_verified=1;
        $tutor->save();
        $request->status=1;
        $request->save();
        
        return redirect()->back();
    }
    public function postDecline(){
        $id=request()->id;
        $message=request()->message;
        $request = VerifiedTutorRequest::findOrFail($id);
        $tutor=$request->tutor;

        $tutor->user->sendNotification('Sorry, Your request for verification has been declined',$message,"#");

        $tutor->is_verified=0;
        $tutor->save();
        $request->status=0;
        $request->save();
        
        return redirect()->back();
    }
}
