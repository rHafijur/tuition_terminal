@extends(getThemePath('layout.layout'))
@section('content')
@push('head')
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

@php
use Carbon\Carbon;
$is_superadmin=false;
    if(auth()->user()->cb_roles_id==1){
        $is_superadmin=true;
    }
@endphp
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> All Tutor</h1>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <ul id="tab_nav" class="nav nav-pills">
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("tutors")}}" class="nav-link active">All Tutors</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("tutors/premium")}}" class="nav-link">Primium Tutors</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("tutors/featured")}}" class="nav-link">Featured Tutors</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$reports['total']}}</h2>
                        <span>All Tutors</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$reports['male']}}</h2>
                        <span>Male Tutors</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$reports['female']}}</h2>
                        <span>Female Tutors</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$reports['premium']}}</h2>
                        <span>Premium Tutors</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$reports['featured']}}</h2>
                        <span>Featured Tutors</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-12">
                    <button onclick="$('#filters').toggleClass('hide')" class="btn btn-light"><i class="fa fa-filter"></i></button>
            <form action="{{cb()->getAdminUrl("tutors")}}" method="GET">
                @if (request()->limit!=null)
                    <input type="hidden" name="limit" value="{{request()->limit}}">
                @endif
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
                            <label for="tutor_gender">Gender</label>
                            <select class="form-control required-input" name="tutor_gender" id="tutor_gender">
                                <option value="">Select Gender</option>
                                <option @if($request->tutor_gender=='male') selected @endif value="male">Male</option>
                                <option @if($request->tutor_gender=='female') selected @endif value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="institute_id">University</label>
                            <select class="form-control required-input select2" name="institute_id" id="institute_id">
                                <option value="">Select University</option>
                                @foreach ($institutes as $institute)
                                    <option @if($institute->id==$request->institute_id) selected @endif value="{{$institute->id}}">{{$institute->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="tutor_department">Depertment</label>
                            {{-- <input class="form-control required-input" name="tutor_department" value="{{$request->tutor_department}}" id="tutor_department" type="text"> --}}
                            <select required name="tutor_department"   class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                                <option value="">Select Study Type</option>
                                @foreach (App\Department::OrderBy('title','asc')->get() as $department)
                                @php
                                    $selected="";
                                    if($request->tutor_department!=null && $request->tutor_department==$department->title){
                                        $selected="selected";
                                    }else{
                                        $selected="";
                                    }
                                @endphp 
                                  <option {{$selected}} value="{{$department->title}}" data-select2-id="{{$department->title}}">{{$department->title}}</option>
                                @endforeach
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
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="background">Background</label>
                            <input class="form-control required-input" value="{{$request->background}}" name="background" id="background" type="text">
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
                            <label for="year">Year</label>
                            <input class="form-control required-input" value="{{$request->year}}" name="year" id="year" type="text">
                        </div>
                        <div class="form-group col">
                            <label for="study_type">Study Type</label>
                            <select class="form-control required-input" name="study_type" id="study_type">
                                <option value="">Select Study Type</option>
                                @foreach (App\StudyType::all() as $st)
                                    <option @if($request->study_type==$st->id)selected @endif value="{{$st->id}}">{{$st->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="university_type">University type</label>
                            <select class="form-control required-input" name="university_type" id="university_type">
                                <option value="">Select University Type</option>
                                <option @if($request->university_type=="Public University")selected @endif value="Public University">Public University</option>
                                <option @if($request->university_type=="National University")selected @endif value="National University">Public University</option>
                                <option @if($request->university_type=="Private University")selected @endif value="Private University">Private University</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="preferred_location_id">Preffered Location</label>
                            <select class="form-control required-input" name="preferred_location_id" data-select2-id="" id="preferred_location_id">
                                <option value="">Select Preffered Location</option>
                                @foreach (App\Location::orderBy('name','asc')->get() as $location)
                                    <option @if($location->id==$request->preferred_location_id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1" style="margin-top:32px">
                            <button class="btn btn-primary" type="submit">Apply Filter</button>
                        </div>
                    </div>
                    
                </div>
            </form>
                    {{-- <form class="form-row"  action="" method="get">
                        @if (request()->limit!=null)
                            <input type="hidden" name="limit" value="{{request()->limit}}">
                        @endif
                        <div class="col-md-3">
                            <select name="city" class="form-control">
                                @php
                                    $city_id=request()->city;
                                @endphp
                                <option value="">Filter City</option>
                                @foreach (App\City::orderBy('name','desc')->get() as $city)
                                    <option @if($city_id==$city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="location" class="form-control">
                                @php
                                    $location_id=request()->location;
                                @endphp
                                <option value="">Filter Location</option>
                                @foreach (App\Location::orderBy('name','desc')->get() as $location)
                                    <option @if($location_id==$location->id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="is_verified" class="form-control">
                                @php
                                    $is_verified=request()->is_verified;
                                @endphp
                                <option value="">Filter Verified</option>
                                <option @if($is_verified==1) selected @endif value="1">Yes</option>
                                <option @if($is_verified ==='0') selected @endif value="0">No</option>
                               
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="is_featured" class="form-control">
                                @php
                                    $is_featured=request()->is_featured;
                                @endphp
                                <option value="">Filter Featured</option>
                                <option @if($is_featured==1) selected @endif value="1">Yes</option>
                                <option @if($is_featured==='0') selected @endif value="0">No</option>
                               
                            </select>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-filter"></i></button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box-tools pull-left" style="position: relative;margin-top: 5px;margin-left: 10px">
                        <button onclick="sendSms()" class="btn btn-primary btn-sm">Send Bulk SMS</button>
                    </div>
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
                            @if (request()->city!=null)
                                <input type="hidden" name="city" value="{{request()->city}}">
                            @endif
                            @if (request()->location!=null)
                                <input type="hidden" name="location" value="{{request()->location}}">
                            @endif
                            @if (request()->is_verified!=null)
                                <input type="hidden" name="is_verified" value="{{request()->is_verified}}">
                            @endif
                            @if (request()->is_featured!=null)
                                <input type="hidden" name="is_featured" value="{{request()->is_featured}}">
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
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <input onchange="chackboxChanged(this)" type="checkbox">
                            </th>
                            <th>Date</th>
                            <th>Tutor ID</th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>University</th>
                            <th>Department</th>
                            <th>Year</th>
                            <th>Completion</th>
                            <th>Phone</th>
                            <th>Last Active</th>
                            <th>Status</th>
                            <th>Channel</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tutors as $tutor)
                        <tr>
                            <td><input class="selector" data-id="{{$tutor->user->id}}" type="checkbox"></td>
                            <td>{{Carbon::parse($tutor->user->created_at)->toDateString()}}</td>
                            <td>{{$tutor->tutor_id}}</td>
                            <td>{{$tutor->user->name}}{!!$tutor->getStatusIcon()!!}</td>
                            <td>{!!$tutor->getRating()!!}</td>
                            <td>
                                @php
                                    $degrees=$tutor->tutor_degrees()->whereIn('degree_id',[3,4])->orderBy('degree_id','desc')->get();
                                @endphp
                                @if ($degrees->count()>0)
                                    {{$degrees[0]->institute->title}}
                                @endif
                            </td>
                            <td>
                                @if ($degrees->count()>0)
                                    {{$degrees[0]->department}}
                                @endif
                            </td>
                            <td>
                                @if ($degrees->count()>0)
                                    {{$degrees[0]->year_or_semester}}
                                @endif
                            </td>
                            <td>
                                {{$tutor->getProfileComplete()}} %
                            </td>
                            <td>
                                {{$tutor->user->phone}}
                            </td>
                            <td>
                                @if ($lastDate=$tutor->user->login_at)
                                    {{Carbon::parse($lastDate)->toDateString()}}
                                @endif
                            </td>
                            <td>
                                <select class="form-control" data-id="{{$tutor->id}}" onchange="statusChanged(this)">
                                    <option @if($tutor->is_active==1) selected @endif value="1">Active</option>
                                    <option @if($tutor->is_active==0) selected @endif value="0">Inactive</option>
                                </select>
                            </td>
                            <td>
                                {{$tutor->user->channel}}
                            </td>
                            <td>
                                <a href="{{ action('AdminTutorsController@getSingle',[$tutor->id]) }}"><button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button></a>
                                <a href="{{ action('AdminTutorsController@getEdit',[$tutor->id]) }}"><button class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button></a>
                                <a href="{{ action('AdminTutorsController@getEdit_info',[$tutor->id]) }}"><button class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>Edit Info
                                </button></a>
                                <form id="bulk_sms_form" method="POST" action="{{ route('sms_editor') }}" target="_blank">
                                    @csrf
                                    <input type="hidden" id="ids" name="ids" value="[{{$tutor->user_id}}]">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-envelope"></i>
                                    </button>
                                </form>
                                @if ($is_superadmin)
                                <form style="display: inline" action="{{ action('AdminTutorsController@postDelete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$tutor->id}}">
                                    <button onclick="confirmDelete(this)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                                @endif
                                @if (!$tutor->isPremium())
                                <form action="{{ action('AdminTutorsController@postMakePremium') }}" method="post" style="display: inline">
                                    @csrf
                                    <input type="hidden" value="{{$tutor->id}}" name="id">
                                    <button class="btn btn-sm btn-primary">Make Premium</button>
                                </form>
                                @endif
                                @if ($tutor->is_featured!=1)
                                <form action="{{ action('AdminTutorsController@postMakeFeatured') }}" method="post" style="display: inline">
                                    @csrf
                                    <input type="hidden" value="{{$tutor->id}}" name="id">
                                    <button class="btn btn-sm btn-primary">Make Featured</button>
                                </form>
                                @endif
                                @if ($tutor->is_verified!=1)
                                <form action="{{ action('AdminTutorsController@postMakeVerify') }}" method="post" style="display: inline">
                                    @csrf
                                    <input type="hidden" value="{{$tutor->id}}" name="id">
                                    <button class="btn btn-sm btn-primary">Verify</button>
                                </form>
                                @endif
                                <button data-toggle="modal" data-target="#noteModal" onclick="openNoteModal({{$tutor->id}},'{{$tutor->user->name}}')" class="btn btn-sm btn-primary">Note</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!!$tutors->appends(request()->query())->links()!!}
            </div>
        </div>
    </div>
    <form id="bulk_sms_form" method="POST" action="{{ route('sms_editor') }}" target="_blank">
        @csrf
        <input type="hidden" id="ids" name="ids">
    </form>

    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="noteModalLabel">Add Note for <span id="noteModalTutorName"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="tutorNoteForm" action="{{ action('AdminTutorsController@postSaveNote') }}" method="post">
                <input type="hidden" name="id" id="noteModalTutorId">
                @csrf
                <div class="form-group">
                    <label>Note</label>
                    <textarea name="note" class="form-control" required></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" onclick="$('#tutorNoteForm').submit()" class="btn btn-primary">Save Note</button>
            </div>
          </div>
        </div>
      </div>

    <script>
        function confirmDelete(obj){
            if(confirm("Do you really want to delete this?")==true){
                $(obj).closest('form').submit();
            }
        }
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
        function statusChanged(el){
            var id=$(el).data('id');
            $.post(`{{ action('AdminTutorsController@postChangeActiveStatus') }}`,
            {
                id:id,
                is_active:el.value,
                _token:$('meta[name="csrf-token"]').attr('content')
            },
            function(data,status){

            }
            );
        }
        function openNoteModal(id,name){
            $("#noteModalTutorName").text(name);
            $("#noteModalTutorId").val(id);
        }

        const resource=JSON.parse(`{!!json_encode($categories_collection)!!}`);
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
    </script>
@endsection