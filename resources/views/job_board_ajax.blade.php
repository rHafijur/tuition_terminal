@php
    use Carbon\Carbon;
@endphp
@if (count($job_offers)>0)
@foreach ($job_offers as $offer)

@if($offer->isLive())
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
            <p>tutoring duration : <span>{{$offer->tutoring_duration}} hour</span></p>
            <p>{{$offer->days_in_week}} days per week</p>
            <p>Salary: <span class="sallery-text">{{$offer->min_salary}} - {{$offer->max_salary}},</span> </p>
         </div>
         <div class="col-md-6">
            <p class="tutor-gender">Tutor gender requrement : <span>  @if($offer->tutor_gender == null)  Any  @else {{$offer->tutor_gender}} @endif</span> </p>
            <p>Requirements : {{$offer->requirements}}<span></span></p>
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
      <button class="btn btn-secondary cpy" style="float:left" data-clipboard-text="{{route('job_detail',['id'=>$offer->id])}}" onclick="alert('The link is copied!')">
         Copy link
     </button>
      <a href="{{route('job_detail',['id'=>$offer->id])}}" target="_blank" style="float: left;margin-left:10px;">
         <button type="button" class="btn btn3 btn-job-view">View details</button>
      </a>
      @if (!Auth::check() || in_array(auth()->user()->cb_roles_id, [1, 2]))
                                <form action="#">
                                  <button class="btn btn-success"  id="nplogin" style="padding: 3px 12px" type="button">Apply Now</button>
                                </form>
                           @else
                                @php
                                 $personal_info=$tutor->tutor_personal_information;
                                @endphp
                                 @if ($tutor->is_active == 1)
                                        @if ($tutor->getProfileComplete() >= 80)
                                                @if (!$offer->already_applied())
                                                <form action="{{route('apply_to_job_offer')}}" method="post">
                                                  @csrf
                                                  <input type="hidden" name="job_offer_id" value="{{$offer->id}}">
                                                  @if ( $offer->tutor_gender == $personal_info->gender || $offer->tutor_gender == null)
                                                 
                                                  <button class="btn btn-success  applyJobSignInButton" data-job_id="30" id="npsucess" style="padding: 3px 12px" type="submit">Apply Now</button>
                                                  @else
                                                  <button class="btn btn-success" id="npgender" style="padding: 3px 12px" type="button">Apply Now</button>
                                                  @endif
                                                </form>
                                                @else
                                                <button class="btn btn-success" id="nperror" style="padding: 3px 12px" type="button">Already Applied</button> 
                                                @endif
                                            @else    
                                              <button class="btn btn-success" id="npcomplete" style="padding: 3px 12px" type="button">Apply Now</button>   
                                        @endif
                                    @else
                                    <button class="btn btn-success" id="inactive" style="padding: 3px 12px" type="button">Apply Now</button> 
                                @endif
                           @endif
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
@else
<div class="tutor-post-block" style="background:#ececec00;pointer-events: none;">
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
                                 <p>tutoring duration : <span>{{$offer->tutoring_duration}} hour</span></p>
                                 <p>{{$offer->days_in_week}} days per week</p>
                                 <p>Salary: <span class="sallery-text">{{$offer->min_salary}} - {{$offer->max_salary}},</span> </p>
                              </div>
                              <div class="col-md-6">
                                 <p class="tutor-gender">Tutor gender requrement : <span>  @if($offer->tutor_gender == null)  Any  @else {{$offer->tutor_gender}} @endif</span> </p>
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
                           <button class="btn btn-secondary cpy" style="float:left">
                              Copy link
                          </button>
                           <a href="#" target="_blank" style="float: left;margin-left:10px;">
                              <button type="button" class="btn btn3 btn-job-view">View details</button>
                           </a>
                           <form action="#">
                              
                              <button class="btn btn-danger  applyJobSignInButton" data-job_id="30" style="padding: 3px 12px" type="submit">Not Available</button>
                           </form>
                        </div>
                        <!-- Map Javascript Api -->
                       
                     </div>
                     
                     @endif
                     
@endforeach
{{$job_offers->links()}}
@else
<h1>No Results Found!</h1>
@endif