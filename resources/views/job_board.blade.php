@extends('layouts.fornt_app')
@section('content')
@push('css')
      <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin_lte/plugins/sweetalert2/sweetalert2.min.css')}}">
  <script src="{{asset('admin_lte/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

  <style>
     .courses{
        margin-left: 15px;
     }
  </style>
@endpush
@push('js')
    <!-- Select2 -->
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script>
   new ClipboardJS('.cpy');
</script>
<script src="{{asset('admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
<script type:"text/javascipt">
    
   
     $(document).on('click', '#npsucess', function(e) {
            swal.fire(
                'You are applied for the job!',
                'Thanks for applying',
                'success'
            )
        });
     $(document).on('click', '#nperror', function(e) {
            swal.fire(
                'You are already applied!',
                'Apply For Another Job',
                'error'
            )
        }); 
    $(document).on('click', '#npcomplete', function(e) {
            swal.fire(
                'Profile Incomplete!',
                'Complete your profile to 80%',
                'error'
            )
        }); 
     $(document).on('click', '#npgender', function(e) {
            swal.fire(
                'Profile Gender Mismatch',
                'This offer is for specific gender, you cannot apply this offer',
                'error'
            )
        });
     $(document).on('click', '#nplogin', function(e) {
            swal.fire(
                'Login First!',
                'Please Login as a tutor to apply this job!',
                'error'
            )
        });
    $(document).on('click', '#inactive', function(e) {
            swal.fire(
                'Inactive Profile!',
                'Please contact with administrator to active your profile.',
                'error'
            )
        });

    
</script>
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
                     @if($offer->isLive())
                 
                     <div class="tutor-post-block" >
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
                                 <p class="tutor-gender">Tutor gender requrement : <span> @if($offer->tutor_gender == null)  Any  @else {{$offer->tutor_gender}} @endif</span> </p>
                                 <p>Requirements : <span>{{$offer->requirements}}</span></p>
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
                                 <p class="tutor-gender">Tutor gender requrement : <span> @if($offer->tutor_gender == null)  Any  @else {{$offer->tutor_gender}} @endif</span> </p>
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
                           <form action="{{route('apply_to_job_offer')}}" method="post">
                              @csrf
                              <input type="hidden" name="job_offer_id" value="{{$offer->id}}">
                              <button class="btn btn-danger  applyJobSignInButton" data-job_id="30" style="padding: 3px 12px" type="submit">Not Available</button>
                           </form>
                        </div>
                        <!-- Map Javascript Api -->
                        
                     </div>
                     
                     @endif
                     @endforeach
                     {{$job_offers->links()}}
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
                           <option value="">Select One</option>
                           @foreach (App\City::OrderBy('name','asc')->get() as $city)
                           
                            <option value="{{$city->id}}" @if(request()->city_id==$city->id) selected @endif data-select2-id="{{$city->id}}">{{$city->name}}</option>
                          @endforeach
                        </select>
                      </div>
                   </div>
                   <div id="location_show" class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px; padding-right: 0px;@if(request()->city_id==null) display:none @endif">
                     <div style="padding-left: 0px;padding-right: 0px;" class="form-group">
                        <label>Location</label>
                        <select onchange="stateChanged()" name="location" id="s2_location"  class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                           @if ($c_id= request()->city_id)
                               @php
                                   $city=App\City::find($c_id);
                               @endphp
                               <option value="">Select One</option>
                                 @foreach ($city->locations()->orderBy('name','asc')->get() as $location)
                                   <option value="{{$location->id}}" @if(request()->location_id==$location->id) selected @endif data-select2-id="{{$location->id}}">{{$location->name}}</option>
                                 @endforeach
                           @endif
                        </select>
                      </div>
                   </div>
                </div>
                <div class="filter-category-content">
                   <h4>Category</h4>
                   <div class="row">
                      <div id="category_show" class="col-md-12">
                         @php
                             $cat_ids= request()->category_ids;
                             if($cat_ids==null){
                                $cat_ids=[];
                             }
                             $cor_ids= request()->course;
                             if($cor_ids==null){
                                $cor_ids=[];
                             }
                         @endphp
                         @foreach ($categories as $category)
                         @php
                             $is_active= in_array($category->id,$cat_ids);
                         @endphp
                           <div class="cat">
                              <div class="checkbox">
                                 <label for="category_2" style="font-size:13px;font-family: 'Poppins', sans-serif;cursor: pointer;">
                                 <input onchange="categoryChanged(this);stateChanged();" @if($is_active) checked @endif type="checkbox" class="category styled" name="category[]" value="{{$category->id}}">                                                
                                 {{$category->title}}</label>
                              </div>
                              <div class="courses">
                                 @if ($is_active)
                                     @foreach ($category->courses as $course)
                                       <div class="checkbox">
                                          <label for="" style="font-size:13px;font-family: 'Poppins', sans-serif;cursor: pointer;">
                                          <input checked onchange="stateChanged()" @if(in_array($course->id,$cor_ids)) checked @endif  type="checkbox" class="course styled" name="course[]" value="{{$course->title}}">                                                
                                          {{$course->title}}
                                       </label>
                                       </div>
                                     @endforeach
                                 @endif
                              </div>
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
                         @php
                             $gens=request()->genders;
                             if($gens==null){
                                $gens=[];
                             }
                         @endphp
                      </div>
                      <div class="col-xs-6 col-md-6" style="float: left; text-align: left; padding-left: 0px;">
                         <div class="styled-input-single">
                            <input onchange="stateChanged()" @if(in_array('male',$gens)) checked @endif type="checkbox" id="Male" class="gender styled" name="gender[]" value="male"">
                            <label for="Male" class="input-label-checkbox">
                            Male
                            </label>
                         </div>
                      </div>
                      <div class="col-xs-6 col-md-6" style="float: left; text-align: left; padding-left: 5px;">
                         <div class="styled-input-single">
                            <input onchange="stateChanged()" @if(in_array('female',$gens)) checked @endif  type="checkbox" id="Female" class="gender styled" name="gender[]" value="female">
                            <label for="Female" class="input-label-checkbox">
                            Female
                            </label>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="filter-category-content">
                  <h4>Teaching Methods</h4>
                  @php
                      $tms=request()->teaching_method_ids;
                      if($tms==null){
                         $tms=[];
                      }
                  @endphp
                  <div class="row">
                     <div id="category_show" class="col-md-12">
                        @foreach ($teaching_methods as $teaching_method)
                        <div class="checkbox">
                           <label style="font-size:13px;font-family: 'Poppins', sans-serif;cursor: pointer;">
                           <input onchange="stateChanged();" @if(in_array($teaching_method->id,$tms)) checked @endif type="checkbox" class="teaching_method styled" name="teaching_method[]" value="{{$teaching_method->id}}">                                                
                           {{$teaching_method->title}}</label>
                        </div>
                        @endforeach
                     </div>
                     <div id="class_show" class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px;">
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
   const category_resource=JSON.parse(`{!!json_encode($categories)!!}`);
   // $('#location_show').hide();
   $("#s2_location").select2();
   $("#s2_location").select2();
   $('#job-board-header').hide();
   function getCity(id){
      for(var cit of city_resource){
         if(cit.id==id){
               return cit;
         }
      }
      return null;
   }
   function  getCategory(id){
      for(var cat of category_resource){
         if(cat.id==id){
               return cat;
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
   function categoryChanged(el){
      if(el.checked){
         var cat=getCategory(el.value);
         var html="";
         for(var course of cat.courses){
            html+=`
            <div class="checkbox">
               <label for="" style="font-size:13px;font-family: 'Poppins', sans-serif;cursor: pointer;">
               <input checked onchange="stateChanged()" type="checkbox" class="course styled" name="course[]" value="`+course.id+`">                                                
               `+course.title+`</label>
            </div>
            `;
         }
         $(el).closest('.cat').find('.courses').html(html);
      }else{
         $(el).closest('.cat').find('.courses').empty();
      }
   }
   function currentState(){
      var city_id= $('#s2_city').val();
      var location_id= $('#s2_location').val();
      var category_ids=[];
      var course_ids=[];
      var teaching_method_ids=[];
      var genders=[];
      for(var cat of $('.category')){
         if(cat.checked){
            category_ids.push(cat.value);
         }
      }
      for(var cour of $('.course')){
         if(cour.checked){
            course_ids.push(cour.value);
         }
      }
      for(var tm of $('.teaching_method')){
         if(tm.checked){
            teaching_method_ids.push(tm.value);
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
         course_ids:course_ids,
         teaching_method_ids:teaching_method_ids,
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