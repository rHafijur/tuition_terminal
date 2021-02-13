@extends(getThemePath('layout.layout'))
@php
    $is_sa=false;
    if(auth()->user()->cb_roles_id==1){
        $is_sa=true;
    }
@endphp
@section('content')
@php
   use Carbon\Carbon;
@endphp
@push('head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
<style>
    .report-card{
        background-color: #0ca1c7;
        color: #FFFFFF;
        text-align: center;
        padding: 15px 0 15px 0;
        margin-top: 10px;
    }
    .report-card > span{
        font-size: 20px;
    }
    
</style>
@endpush
@push('bottom')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i>All Job Offers</h1>
            <div class="row">
                <ul id="tab_nav" class="nav nav-pills">
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/available-offers")}}" class="nav-link active">Available Offers</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/all")}}" class="nav-link">All Offers</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/applications")}}" class="nav-link">Applications</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/add_new")}}" class="nav-link">Add New Tuiton</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$all_offer_cnt}}</h2>
                        <span>All Offers</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$available_offer_cnt}}</h2>
                        <span>Available Offers</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$pending_offer_cnt}}</h2>
                        <span>Pending Offers</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$todays_offer_cnt}}</h2>
                        <span>Today's Offers</span>
                    </div>
                </div>
            </div>
            <button onclick="$('#filters').toggleClass('hide')" class="btn btn-light"><i class="fa fa-filter"></i></button>
            <form action="{{cb()->getAdminUrl("job_offers/available-offers")}}" method="GET">
                <div id="filters" class="hide card card-body">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>From</label>
                            <input type="date" class="form-control" value="{{$request->from}}" name="from">
                        </div>
                        <div class="form-group col-md-2">
                            <label>To</label>
                            <input type="date" class="form-control" value="{{$request->to}}" name="to">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="city_id">City</label>
                            <select onchange="cityChanged(this)" class="form-control required-input select2" name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @foreach ($city_collection as $city)
                                    <option @if($city->id==$request->city_id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="location_id">Location</label>
                            <select class="form-control required-input" name="location_id" data-select2-id="" id="location_id">
                                @if ($request->city_id!=null)
                                    @php
                                        $scity=App\City::find($request->city_id);
                                    @endphp    
                                    @foreach ($scity->locations as $location)
                                        <option @if($location->id==$request->location_id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="category_id">Category</label>
                            <select onchange="categoryChanged(this)" class="form-control required-input" name="category_id" id="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories_collection as $category)
                                    <option @if($category->id==$request->category_id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="course_id">Course</label>
                            <select onchange="courseChanged(this)" class="form-control required-input" name="course_id" id="course_id">
                                @php
                                    $scat=null;
                                    if($request->category_id!=null){
                                        $scat=App\Category::find($request->category_id);
                                    }
                                @endphp
                                @if ($scat!=null)
                                    @foreach ($scat->courses as $course)
                                    <option @if($course->id==$request->course_id) selected @endif value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="course_subject_ids">Subjects</label>
                            @php
                                $ocs=$request->course_subject_ids;
                            @endphp
                            <select class="form-control required-input select2 select2-hidden-accessible" name="course_subject_ids[]" id="course_subject_ids"  multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                                @if ($request->course_id!=null)
                                    @foreach (App\Course::find($request->course_id)->course_subjects as $cs)
                                    @php
                                        $isSelected="";
                                        foreach ($ocs as $oc) {
                                            if($oc==$cs->id){
                                                $isSelected="selected";
                                            break;
                                            }
                                        }
                                    @endphp
                                    <option {{$isSelected}} value="{{$cs->id}}">{{$cs->course->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="time">Tutoring Time</label>
                            <input class="form-control required-input" value="{{$request->time}}" name="time" id="time" type="time">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="salary">Salary</label>
                            <input class="form-control required-input" value="{{$request->salary}}" name="salary" id="salary" type="number">
                        </div>
                        <div class="form-group col">
                            <label for="source">Source</label>
                            <select class="form-control required-input" name="source" id="source">
                                <option value="">Select Source</option>
                                <option @if($request->source=="Facebook") selected @endif value="Facebook">Facebook</option>
                                <option @if($request->source=="Google") selected @endif value="Google">Google</option>
                                <option @if($request->source=="Offline Marketing") selected @endif value="Offline Marketing">Offline Marketing</option>
                                <option @if($request->source=="Lead Offer") selected @endif value="Lead Offer">Lead Offer</option>
                                <option @if($request->source=="Other") selected @endif value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="taken_by_id">Taken By</label>
                            <select class="form-control required-input select2" name="taken_by_id" id="taken_by_id">
                                <option value="">Select User</option>
                                @foreach (App\User::whereIn('cb_roles_id',[1,2])->get() as $user)
                                    <option @if($user->id==$request->taken_by_id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="channel">Channel</label>
                            <select class="form-control required-input" name="channel" id="channel">
                                <option value="">Select channel</option>
                                <option @if($request->channel=="Apps") selected @endif value="Apps">Apps</option>
                                <option @if($request->channel=="Website") selected @endif value="Website">Website</option>
                                <option @if($request->channel=="System") selected @endif value="System">System</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="tutor_gender">Tutor's Gender</label>
                            <select class="form-control required-input" name="tutor_gender" id="tutor_gender">
                                <option value="">Select Gender</option>
                                <option @if($request->tutor_gender=='male') selected @endif value="male">Male</option>
                                <option @if($request->tutor_gender=='female') selected @endif value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="tutor_department">Depertment</label>
                            <input class="form-control required-input" name="tutor_department" value="{{$request->tutor_department}}" id="tutor_department" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="reference_name">Remarks</label>
                            <input class="form-control required-input" name="reference_name" value="{{$request->reference_name}}" id="reference_name" type="text">
                        </div>
                        <div class="form-group col-md-1" style="margin-top:32px">
                            <button class="btn btn-primary" type="submit">Apply Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="box-tools pull-left" style="position: relative;margin-top: 5px;margin-left: 10px">
                        <button onclick="sendSms()" class="btn btn-primary btn-sm">Send Bulk SMS</button>
                    </div>
                    <form id="bulk_sms_form" method="POST" action="{{ route('sms_editor') }}" target="_blank">
                        @csrf
                        <input type="hidden" id="ids" name="ids">
                    </form>
                    <div class="box-tools pull-right" style="position: relative;margin-top: 5px;margin-right: 10px">

                        <form method="get" style="display:inline-block;width: 260px;" action="{{request()->fullUrl()}}">
            
                            <div class="input-group">
                                <input type="text" name="q" value="{{request()->q}}" class="form-control input-sm pull-right" placeholder="Search">
                                @if (request()->limit!=null)
                                    <input type="hidden" name="limit" value="{{request()->limit}}">
                                @endif
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
        
                        <form method="get" id="form-limit-paging" style="display:inline-block" action="{{request()->fullUrl()}}">
                            @if (request()->q!=null)
                                <input type="hidden" name="q" value="{{request()->q}}">
                            @endif
                            <div class="input-group">
                                <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;" class="form-control input-sm">
                                    @php
                                        $limit=request()->limit;
                                    @endphp
                                    <option value="10">10</option>
                                    <option @if($limit==20) selected @endif value="20">20</option>
                                    <option @if($limit==25) selected @endif value="25">25</option>
                                    <option @if($limit==50) selected @endif value="50">50</option>
                                    <option @if($limit==100) selected @endif value="100">100</option>
                                    <option @if($limit==200) selected @endif value="200">200</option>
                                </select>
                            </div>
                        </form>
        
                </div>
                </div>
            </div>
        </div>
        <div class="box-body"> 
            <div class="row d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <input onchange="chackboxChanged(this)" type="checkbox">
                            </th>
                            <th>Date</th>
                            <th>Job Id</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Phone</th>
                            <th>T Gender</th>
                            <th>T University Type</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>EM-1</th>
                            <th>EM-2</th>
                            <th>Applied Tutors</th>
                            <th>Live</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job_offers as $offer)
                        @php
                            $dt=Carbon::parse($offer->created_at);
                            $checked="";
                            if($offer->is_active==1){
                                $checked="checked";
                            }
                        @endphp
                        <tr>
                            <td><input class="selector" data-id="{{$offer->parents->user_id}}" type="checkbox"></td>
                            <td>{{$dt->toDateString()}}</td>
                            <td>
                                <a href="{{cb()->getAdminUrl("job_offers/detail/".$offer->id)}}" target="_blank">{{$offer->id}}</a>
                            </td>
                            <td>{{$offer->category->title}}</td>
                            <td>{{$offer->course->title}}</td>
                            <td>{{$offer->location->name}}, {{$offer->city->name}}</td>
                            <td>{{$offer->min_salary}} - {{$offer->max_salary}}</td>
                            <td>{{$offer->phone}}</td>
                            <td>{{$offer->tutor_gender}}</td>
                            <td>
                                {{-- @if ($offer->tutor_study_type!=null)
                                {{$offer->tutor_study_type->title}}
                                @endif --}}
                                {{$offer->university_type}}
                            </td>
                            <td>
                                {{$offer->reference_name}}
                            </td>
                            <td>{{$offer->getStatus()}}</td>
                            <td>
                                @if ($offer->em1!=null)
                                {{$offer->em1->name}}
                                @endif
                            </td>
                            <td>
                                @if ($offer->em2!=null)
                                {{$offer->em2->name}}
                                @endif
                            </td>
                            <td>
                                <a href="{{cb()->getAdminUrl("job_offers/application-list/".$offer->id)}}" target="_blank" ><span>{{$offer->applications->count()}}</span> <span class="badge badge-pill badge-info">{{$offer->applications()->where('is_seen',0)->get()->count()}}</span></a>
                            </td>
                            <td>
                                <input onchange="activeChanged(this,{{$offer->id}})" type="checkbox" {{$checked}} data-toggle="toggle">
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" onclick="loadDataToCurrentConditoinModal({{$offer->id}})" data-toggle="modal" data-target="#currentConditionModal">Condition</button>
                                <a href="{{cb()->getAdminUrl("job_offers/edit/".$offer->id)}}" target="_blank"><button class="btn btn-warning btn-sm">Edit</button></a>
                                @if ($is_sa)
                                <a href="{{cb()->getAdminUrl("job_offers/delete/".$offer->id)}}"><button class="btn btn-danger btn-sm">Delete</button></a>
                                @endif
                                <button type="button" class="btn btn-info btn-sm" onclick="loadDataToSearchTutorModal({{$offer->id}})" data-toggle="modal" data-target="#searchTutorModal">Search Tutor</button>
                            </td>
                        </tr>                         
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="currentConditionModal" tabindex="-1" aria-labelledby="currentConditionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="currentConditionModalLabel">Current Condition</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="currentConditionModalBody">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="searchTutorModal" tabindex="-1" aria-labelledby="searchTutorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="searchTutorModalLabel">Search Tutors</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="searchTutorModalBody">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection
@push('bottom')
<script>
        function chackboxChanged(obj){
            for(var selector of $('.selector')){
                selector.checked=obj.checked;
            }
        }
        function sendSms(){
            var ids=[];
            for(var selector of $('.selector')){
                if(selector.checked){
                    ids.push($(selector).data('id'));
                }
            } 
            if(ids.length<1){
                alert("Please select atleast one tutor");
                return;
            }
            $("#ids").val(JSON.stringify(ids));
            $("#bulk_sms_form").submit();
        }
        const resource=JSON.parse(`{!!json_encode($categories_collection)!!}`);
        const courses_resource=JSON.parse(`{!!json_encode($courses_collection)!!}`);
        const city_resource=JSON.parse(`{!!json_encode($city_collection)!!}`);
        function  getCategory(id){
            for(var cat of resource){
                if(cat.id==id){
                    return cat;
                }
            }
            return null;
        }
        function  getCourse(id){
            for(var cour of courses_resource){
                if(cour.id==id){
                    return cour;
                }
            }
            return null;
        }
        function  getCity(id){
            for(var cit of city_resource){
                if(cit.id==id){
                    return cit;
                }
            }
            return null;
        }
        function generateCourses(cat_id){
            var  html='';
            var selected="";
            var category = getCategory(cat_id);
                if(category!=null){
                    if(category.courses.length>0){
                        var chtml=`<option  value="">Select Course</option>`;
                        for(var c of category.courses){
                            chtml+=`<option  value="`+c.id+`" data-select2-id="`+c.id+`">`+c.title+`</option>`;
                        }
                        html+=chtml;
                    }
                }
            return html;
        }
        function generateSubjects(id){
            var  html='';
            var course = getCourse(id);
                if(course!=null){
                    if(course.subjects.length>0){
                        var shtml=`<option  value="">Select Course</option>`;
                        for(var s of course.subjects){
                            shtml+=`<option value="`+s.pivot.id+`" data-select2-id="`+s.pivot.id+`">`+s.title+`</option>`;
                        }
                        html+=shtml;
                    }
                }
            return html;
        }
        function categoryChanged(obj){
            var id=$(obj).val();
            //   console.log(id);
            //   console.log(generateCourses(id));
            $("#course_id").html(generateCourses(id));
            // $("#course_id").select2();
            courseChanged(document.getElementById("course_id"));
        }
        function courseChanged(obj){
            var id=$(obj).val();
            //   console.log(generateCourses(ids));
            $("#course_subject_ids").html(generateSubjects(id));
            $("#course_subject_ids").select2();
        }
        function cityChanged(obj){
            var city=getCity($(obj).val());
            var html="";
            for(var loc of city.locations){
                html+=`<option value="`+loc.id+`" data-select2-id="`+loc.id+`">`+loc.name+`</option>`;
            }
            console.log(html);
            $("#location_id").html(html);
            $("#location_id").select2();

        }

        var loading=`
        Loading...
        `;
        function activeChanged(el,id){
            var stat=0;
            if(el.checked){
                stat=1;
            }
            $.get('{{cb()->getAdminUrl("job_offers/change-active")}}'+'/'+id+"/"+stat,function(data,status){
                // console.log(status);
                // console.log(data);
            });
        }
        function loadDataToCurrentConditoinModal(id){
            $("#currentConditionModalBody").html(loading);
            $.get('{{cb()->getAdminUrl("job_offers/offer-current-condition")}}'+'/'+id,function(data,status){
                if(status=="success"){
                    $("#currentConditionModalBody").html(data);
                }else{
                    $("#currentConditionModalBody").html("Something went wrong, please try again");
                }
            });
        }
        function loadDataToSearchTutorModal(id){
            $("#searchTutorModalBody").html(loading);
            $.get('{{cb()->getAdminUrl("job_offers/offer-search-tutor")}}'+'/'+id,function(data,status){
                if(status=="success"){
                    $("#searchTutorModalBody").html(data);
                }else{
                    $("#searchTutorModalBody").html("Something went wrong, please try again");
                }
            });
        }
    </script>
    
@endpush