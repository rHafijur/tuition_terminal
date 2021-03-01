<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JobApplication;

class JobApplicationController extends Controller
{
    public function apply_to_job_offer(Request $request){
       
       $dubliChecker = auth()->user()->tutor->job_applications()->where('job_offer_id', '=', $request->job_offer_id)->first();
       
       if ($dubliChecker != null) {
            
       return redirect()->back()->with('error','Already applied to the job offer');
        }


        JobApplication::create([
            'job_offer_id'=>$request->job_offer_id,
            'tutor_id'=>auth()->user()->tutor->id,
        ]);
        return redirect()->back()->with('success','Successfully applied to the job offer');
    }
}
