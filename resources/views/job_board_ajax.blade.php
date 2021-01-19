@php
    use Carbon\Carbon;
@endphp
@if (count($job_offers)>0)
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
            <span> {{$offer->location->name}}, {{$offer->city->name}}</span>
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
            <p>tutoring duration : <span>1 hour</span></p>
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
      <button class="btn btn-secondary cpy" style="float:left" data-clipboard-text="{{route('job_detail',['id'=>$offer->id])}}">
         Copy link
     </button>
      <a href="{{route('job_detail',['id'=>$offer->id])}}" target="_blank" style="float: left;margin-left:10px;">
         <button type="button" class="btn btn3 btn-job-view">View details</button>
      </a>
      <form action="{{route('apply_to_job_offer')}}" method="post">
         @csrf
         <input type="hidden" name="job_offer_id" value="{{$offer->id}}">
         <button class="btn btn-success  applyJobSignInButton" data-job_id="30" style="padding: 3px 12px" type="submit">Apply Now</button>
      </form>
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
@else
<h1>No Results Found!</h1>
@endif