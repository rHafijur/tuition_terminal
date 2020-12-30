<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

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
}
