<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JobApplication;

class JobApplicationController extends Controller
{
    public function apply_to_job_offer(Request $request){
        JobApplication::create([
            'job_offer_id'=>$request->job_offer_id,
            'tutor_id'=>auth()->user()->tutor->id,
        ]);
        return redirect()->back()->with('success','Successfully applied to the job offer');
    }
}
