<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use App\PremiumMembershipRequest;

class AdminPremiumMembershipRequestsController extends CBController {


    public function cbInit()
    {
        $this->setTable("premium_membership_requests");
        $this->setPermalink("premium_membership_requests");
        $this->setPageTitle("Premium Membership_requests");

        $this->addText("Status","status")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
    public function getIndex(){
        if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $page_title="Primum Membership Requests";
        $requests=PremiumMembershipRequest::orderBy('id','desc')->get();
        return view('admin.premium_membership_request.all',\compact('requests','page_title'));
    }
    public function getGrant($id){
        $request = PremiumMembershipRequest::findOrFail($id);
        $tutor=$request->tutor;

        $tutor->user->sendNotification('Your Request for Premium Membership has been accepted!','Congratulations! Your are now Premium Member',"#");

        $tutor->is_verified=1;
        $tutor->save();
        $request->status=1;
        $request->save();
        
        return redirect()->back();
    }
    public function postDecline(){
        $id=request()->id;
        $message=request()->message;
        $request = PremiumMembershipRequest::findOrFail($id);
        $tutor=$request->tutor;

        $tutor->user->sendNotification('Sorry, Your request for verification has been declined',$message,"#");

        $tutor->is_verified=0;
        $tutor->save();
        $request->status=0;
        $request->save();
        
        return redirect()->back();
    }
}
