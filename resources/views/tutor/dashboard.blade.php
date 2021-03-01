@extends('tutor.layouts.master',['title'=>'Dashboard'])
@php
    use Carbon\Carbon;
@endphp
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
@endpush
@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12" id="landing_job_list_div" style="padding-left: 0px !important;">
    @foreach ($job_offers as $offer)
    <div class="tutor-post-block">
      <div class="tutor-post-header">
         <div class="d-flex justify-content-between">
            <div>
               <h4>Need a tutor for {{$offer->course->title}} student</h4>
            </div>
            <div class="job-id">
               job Id {{$offer->id}}                                          
            </div>
         </div>
         <div class="d-flex justify-content-between">
            <div class="p-2 p-r">
               <i class="fas fa-map-marker-alt"></i>
               <span> {{$offer->city->name}}, {{$offer->location->name}}</span>
            </div>
            <div class="p-2 posted-date p-r">
               {{Carbon::parse($offer->created_at)->format('jS\\, F Y')}}                                        
            </div>
         </div>
      </div>
      <div class="tutor-post-body-content">
         <div class="row">
            <div class="col-md-6">
               <p class=" class">Class: <span> {{$offer->course->title}}</span></p>
               <p>tutoring duration : <span>{{$offer->tutoring_duration}} hour</span></p>
               <p>{{$offer->days_in_week}} days per week</p>
               <p>Salary: <span class="sallery-text">{{$offer->min_salary}} - {{$offer->max_salary}},</span> </p>
            </div>
            <div class="col-md-6">
               <p class="tutor-gender">Tutor gender requrement : <span> {{$offer->tutor_gender}}</span> </p>
               <p>Requirements : {{$offer->requirementsrequirements}}<span></span></p>
               <p>Special notes : <span>{{$offer->spicial_note}}</span></p>
            </div>
         </div>
      </div>
      <div class="tutor-footer-top">
         <div class="d-flex justify-content-between">
            <div>
               <p class=" category">Category: <span>{{$offer->category->title}}</span></p>
            </div>
            <div>
               <p class=" gender">Student Gender: <span>{{$offer->student_gender}}</span> </p>
            </div>
            <div>
               <p> No. of Students : <span class="student-txt">{{$offer->number_of_students}}</span> </p>
            </div>
         </div>
      </div>
      <div class="tutor-post-footer text-right"> 
      {{-- <button type="button" class="btn btn3 btn-job-view" data-toggle="modal" data-target="#jobDetailsModalCenter">View details</button> --}}
        <div class="row">
           <div class="col-md-10"></div>
            <div class="col-md-1">
               <a href="{{route('tutor.job_detail',['id'=>$offer->id])}}">
                  <button class="btn btn-info  applyJobSignInButton"style="padding: 3px 12px" type="button">Detail</button>    
               </a>
            </div>
            <div class="col-md-1">
               @if (!$offer->already_applied())
                     <form action="{{route('apply_to_job_offer')}}" method="post">
                     @csrf
                     <input type="hidden" name="job_offer_id" value="{{$offer->id}}">
                     <button class="btn btn-success  applyJobSignInButton" data-job_id="30" style="padding: 3px 12px" type="submit">Apply Now</button>
                     </form>
               @else
               <button class="btn btn-success  applyJobSignInButton" disabled data-job_id="30" style="padding: 3px 12px" type="button">Apply Now</button>    
               @endif
            </div>
        </div>
      </div>
      <!-- Map Javascript Api -->
      {{-- <div class="col-md-12 collapse" id="collapse_30">
         <div class="row">
            <div class="col-md-12">
               <div id="map_location_30" style="height: 300px; width: 100%; padding-top: 10px"></div>
            </div>
            <!-- <div class="col-md-6">
               <div id="map_direction_panel_30" style="height: 300px; width: 100%; padding-top: 10px; overflow: scroll"></div>
               </div> -->
            <div class="col-md-12">
               <br>
               <hr>
               <p>The exact location of this tuition job is inside this 100-meter circle</p>
            </div>
         </div>
      </div> --}}
   </div>
    @endforeach
    {{-- <div class="tutor-post-block">
       <div class="tutor-post-header">
          <div class="d-flex justify-content-between">
             <div>
                <h4>Need a tutor for Class 2 student</h4>
             </div>
             <div class="job-id">
                job Id 29                                            
             </div>
          </div>
          <div class="d-flex justify-content-between">
             <div class="p-2 p-r">
                <i class="fas fa-map-marker-alt"></i>
                <span> Dhaka, Monipur</span>
             </div>
             <div class="p-2 posted-date p-r">
                24th October, 2020                                            
             </div>
          </div>
       </div>
       <div class="tutor-post-body-content">
          <div class="row">
             <div class="col-md-6">
                <p class=" class">Class: <span> Class 2</span></p>
                <p>Subjects : <span class="all-sub">Bangla</span> </p>
                <p>tutoring duration : <span>1 hour</span></p>
                <p> days per week</p>
                <p>Salary: <span class="sallery-text">2000,</span> </p>
             </div>
             <div class="col-md-6">
                <p class="tutor-gender">Tutor gender requrement : <span> Female</span> </p>
                <p>Requirements : <span></span></p>
                <p>Special notes : <span></span></p>
             </div>
          </div>
       </div>
       <div class="tutor-footer-top">
          <div class="d-flex justify-content-between">
             <div>
                <p class=" category">Category: <span>Bangla Medium</span></p>
             </div>
             <div>
                <p class=" gender">Student Gender: <span>Male</span> </p>
             </div>
             <div>
                <p> No. of Students : <span class="student-txt">1</span> </p>
             </div>
          </div>
       </div>
       <div class="tutor-post-footer text-right">
          <button class="btn btn-success  applyJobSignInButton" data-job_id="29" style="padding: 3px 12px" type="button">Apply Now</button>
       </div>
       <!-- Map Javascript Api -->
       <div class="col-md-12 collapse" id="collapse_29">
          <div class="row">
             <div class="col-md-12">
                <div id="map_location_29" style="height: 300px; width: 100%; padding-top: 10px"></div>
             </div>
             <!-- <div class="col-md-6">
                <div id="map_direction_panel_29" style="height: 300px; width: 100%; padding-top: 10px; overflow: scroll"></div>
                </div> -->
             <div class="col-md-12">
                <br>
                <hr>
                <p>The exact location of this tuition job is inside this 100-meter circle</p>
             </div>
          </div>
       </div>
    </div> --}}
  </div>
</div>
@endsection