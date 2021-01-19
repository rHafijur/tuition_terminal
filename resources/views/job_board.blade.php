@extends('layouts.fornt_app')
@section('content')
@push('css')
      <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('js')
    <!-- Select2 -->
<script src="{{asset('admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
@php
    use Carbon\Carbon;
@endphp
<div class="job-board-main-area">
    <div class="container">
       <div class="row">
          <div class="col-sm-12">
             <div class="job-board-header">
                <h4 id="job-board-header">Tutor jobs in <span id="city_name">Dhaka</span> City</h4>
                <div class="breadcumb">
                   <span><a href="{{url('/')}}">Home</a></span> <span class="arrow">&gt;</span> <span class="bread-active"><a href="#">Jobs board</a></span>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-8">
             <div class="job-board-body-content">
                <!--item1-->
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
                        {{-- <button type="button" class="btn btn3 btn-job-view" data-toggle="modal" data-target="#jobDetailsModalCenter">View details</button> --}}
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
                </div>
             </div>
             <nav>
                <center></center>
             </nav>
          </div>
          <div class="col-md-4">
             <div class="job-board-filter">
                <div class="filter-header">
                   <div class="d-flex justify-content-between  mb-3">
                      <div class="p-2 job-p">
                         <i class="fas fa-filter"></i>
                         <span class="f-t">Filter</span>
                      </div>
                      <div class="p-2 job-p">
                         <a href="{{route('job_board')}}"><span><i>Reset all fields</i></span></a>
                      </div>
                   </div>
                </div>
                <div class="row filter-city-content">
                   <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                      <div style="padding-left: 0px;padding-right: 0px;" class="form-group">
                        <label>City</label>
                        <select name="city" id="s2_city" onchange="cityChanged(this);stateChanged()" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                          @foreach (App\City::OrderBy('name','asc')->get() as $city)
                           <option value="">Select One</option>
                            <option value="{{$city->id}}" data-select2-id="{{$city->id}}">{{$city->name}}</option>
                          @endforeach
                        </select>
                      </div>
                   </div>
                   <div id="location_show" class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px; padding-right: 0px;">
                     <div style="padding-left: 0px;padding-right: 0px;" class="form-group">
                        <label>Location</label>
                        <select onchange="stateChanged()" name="location" id="s2_location"  class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        </select>
                      </div>
                   </div>
                </div>
                <div class="filter-category-content">
                   <h4>Category</h4>
                   <div class="row">
                      <div id="category_show" class="col-md-12">
                         @foreach ($categories as $category)
                           <div class="checkbox">
                              <label for="category_2" style="font-size:13px;font-family: 'Poppins', sans-serif;cursor: pointer;">
                              <input onchange="stateChanged()" type="checkbox" class="category styled" name="category[]" value="{{$category->id}}">                                                
                              {{$category->title}}                                            </label>
                           </div>
                         @endforeach
                      </div>
                      <div id="class_show" class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px;">
                      </div>
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 filter-gender-content" style=" margin-bottom: 20px;">
                   <div class="form-group" style="padding-left: 0px;padding-right: 0px;">
                      <div class="col-xs-12 col-md-12" style="padding-left: 0px;padding-right: 0px;">
                         <label> Gender </label>
                      </div>
                      <div class="col-xs-6 col-md-6" style="float: left; text-align: left; padding-left: 0px;">
                         <div class="styled-input-single">
                            <input onchange="stateChanged()" type="checkbox" id="Male" class="gender styled" name="gender[]" value="male" checked="checked">
                            <label for="Male" class="input-label-checkbox">
                            Male
                            </label>
                         </div>
                      </div>
                      <div class="col-xs-6 col-md-6" style="float: left; text-align: left; padding-left: 5px;">
                         <div class="styled-input-single">
                            <input onchange="stateChanged()" type="checkbox" id="Female" class="gender styled" name="gender[]" value="female" checked="checked">
                            <label for="Female" class="input-label-checkbox">
                            Female
                            </label>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="modal fade tutoring-modal new-tutoring-modal" id="applyJobSignInModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal_loading" id="modal_loading" style="display: none;">
          <img src="https://tutor.iqsademo.com/tuition/assets/panel/img/spinners/spinner_large.gif" alt="" width="64" height="64">
       </div>
       <div class="modal-dialog modal-dialog-centered" style="margin-top: 50px !important;">
          <!--<div class="modal-content" style="border-radius: 0px !important;">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h3 class="modal-title" id="myModalLabel" style="color: #0072bf;">Sign In</h3>
             <hr/>
             </div>
             <form class="form-horizontal apply_job_signin_form" id="apply_job_signin_form" method="post" role="form">
                 <input type="hidden" name="job_id" id="modal_job_id" />
                 <div class="modal-body">
                 <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12 input_margin_bottom">
                    <input type="email" class="form-control" required="required" name="tutor_email" placeholder="Please provide your email id" />
                </div>
             
             <div class="col-xs-12 col-sm-12 col-md-12 input_margin_bottom">
                    <input type="password" class="form-control" required="required" name="tutor_password" placeholder="Enter your password" />
                </div>
                 </div>
             </div>
             
              <div class="modal-footer">
                  <button type="button" class="btn btn-back" id="back_to_first_form" style="display: none;">Back</button>
                              <button type="submit" name="submit_first" class="btn btn-caretutors apply_job_signin" id="apply_job_signin">Continue</button>
                         </div>
                     </form>
                 </div>-->
       </div>
    </div>
 </div>
@endsection

@push('js')
<script>
   $("#s2_city").select2();
   $("#s2_city").select2();
   const city_resource=JSON.parse(`{!!json_encode($city_collection)!!}`);
   $('#location_show').hide();
   $('#job-board-header').hide();
   function  getCity(id){
      for(var cit of city_resource){
         if(cit.id==id){
               return cit;
         }
      }
      return null;
   }
   function cityChanged(obj){
         if(obj.value==""){
            $('#location_show').hide();
            $('#job-board-header').hide();
            return;
         }
         var city=getCity($(obj).val());
         $('#city_name').text(city.name);
         $('#job-board-header').show();
         var html='<option value="">Select One</option>';
         for(var loc of city.locations){
         html+=`<option value="`+loc.id+`" data-select2-id="`+loc.id+`">`+loc.name+`</option>`;
         }
         $('#location_show').show();
         $("#s2_location").html(html);
         $("#s2_location").select2();

   }
   function currentState(){
      var city_id= $('#s2_city').val();
      var location_id= $('#s2_location').val();
      var category_ids=[];
      var genders=[];
      for(var cat of $('.category')){
         if(cat.checked){
            category_ids.push(cat.value);
         }
      }
      for(var gender of $('.gender')){
         if(gender.checked){
            genders.push(gender.value);
         }
      }
      return {
         city_id:city_id,
         location_id:location_id,
         category_ids:category_ids,
         genders:genders
      };
   }
   function stateChanged(){
      var url=`{{route('job_board_ajax')}}`;
      $.get(url,currentState(),function(data,status){
         $("#landing_job_list_div").html(data);
      });
   }
</script>
@endpush