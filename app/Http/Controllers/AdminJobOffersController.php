<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

use App\JobOffer;

class AdminJobOffersController extends CBController {


    public function cbInit()
    {
        $this->setTable("job_offers");
        $this->setPermalink("job_offers");
        $this->setPageTitle("Job Offers");

        $this->addText("ID","id");
    }
    public function getChangeActive($id,$stat){
        $job_offer=JobOffer::findOrFail($id);
        $job_offer->is_active=$stat;
        $job_offer->save();
        return $job_offer->is_active;
    }
    public function getAll(){
        $page_title = "All Job Offers";
        $job_offers = JobOffer::latest()->get();
        // dd($job_offers);
        return view('admin.job_offers.all',\compact('page_title','job_offers'));
    }
}
