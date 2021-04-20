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
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addApplicationModal">+Add New</button>
            </div>
            <div class="row">
                <ul id="tab_nav" class="nav nav-pills">
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/available-offers")}}" class="nav-link">Available Offers</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/all")}}" class="nav-link">All Offers</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/applications")}}" class="nav-link active">Applications</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/add_new")}}" class="nav-link">Add New Tuiton</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$total_cnt}}</h2>
                        <span>Total Applications</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$todays_cnt}}</h2>
                        <span>Today's Applications</span>
                    </div>
                </div>
            </div>
            <button onclick="$('#filters').toggleClass('hide')" class="btn btn-light"><i class="fa fa-filter"></i></button>
            <form action="{{cb()->getAdminUrl("job_offers/applications")}}" method="GET">
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
                            <select class="form-control required-input select2 select2-hidden-accessible" name="course_subject_ids[]" id="course_subject_ids"  multiple="multiple" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
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
                            <label for="reference_name">Remarks</label>
                            <input class="form-control required-input" name="reference_name" value="{{$request->reference_name}}" id="reference_name" type="text">
                        </div>
                    </div>
                    <hr>
                    <h4>Tutor</h4>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="tutor_city_id">City</label>
                            <select onchange="tutorCityChanged(this)" class="form-control required-input select2" name="tutor_city_id" id="tutor_city_id">
                                <option value="">Select City</option>
                                @foreach ($city_collection as $city)
                                    <option @if($city->id==$request->tutor_city_id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="tutor_location_id">Location</label>
                            <select class="form-control required-input" name="tutor_location_id" data-select2-id="" id="tutor_location_id">
                                @if ($request->tutor_city_id!=null)
                                    @php
                                        $scity=App\City::find($request->tutor_city_id);
                                    @endphp    
                                    @foreach ($scity->locations as $location)
                                        <option @if($location->id==$request->tutor_location_id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="channel">Channel</label>
                            <select class="form-control required-input" name="channel" id="channel">
                                <option value="">Select channel</option>
                                <option @if($request->channel=="Apps") selected @endif value="Apps">Apps</option>
                                <option @if($request->channel=="Website") selected @endif value="Website">Website</option>
                                <option @if($request->channel=="System") selected @endif value="System">System</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="tutor_gender">Tutor's Gender</label>
                            <select class="form-control required-input" name="tutor_gender" id="tutor_gender">
                                <option value="">Select Gender</option>
                                <option @if($request->tutor_gender=='male') selected @endif value="male">Male</option>
                                <option @if($request->tutor_gender=='female') selected @endif value="female">Female</option>
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
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="box-body"> 
            <div class="row d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Job ID</th>
                            <th>Course</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                            @php
                                // dd($offer->taken_by->name);
                            @endphp
                            <tr>
                                <td>{{Carbon::parse($offer->created_at)->toDateString()}}</td>
                                <td>{{Carbon::parse($offer->created_at)->toTimeString()}}</td>
                                <td>
                                    <a href="{{cb()->getAdminUrl("job_offers/detail/".$offer->id)}}" target="_blank">{{$offer->id}}</a>
                                </td>
                                <td>
                                    {{$offer->course->title}}
                                </td>
                                <td>
                                    {{$offer->city->name}}, {{$offer->location->name}}
                                </td>
                                <td>
                                    <a href="{{cb()->getAdminUrl("job_offers/application-list/".$offer->id)}}" target="_blank" ><span>{{$offer->applications->count()}}</span> Applications <span class="badge badge-pill badge-info">{{$offer->applications()->where('is_seen',0)->get()->count()}} New</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$offers->links()}}
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="noteModalLabel">Note</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="noteForm" action="{{cb()->getAdminUrl("job_offers/application-update-note")}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="inputNoteId">
                        <textarea name="note" id="inputNoteText" class="form-control" cols="30" rows="7"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" onclick="$('#noteForm').submit()" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="addApplicationModal" tabindex="-1" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addApplicationModalLabel">Add New Application</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="newApplicationForm" action="{{cb()->getAdminUrl("job_offers/new-application")}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="inputJobOfferId">Job Offer ID</label>
                        <input name="id" type="number" id="inputJobOfferId" class="form-control" placeholder="Ex:123" required>
                    </div>
                    <div class="form-group">
                        <label for="inputTutorId">Tutor ID</label>
                        <input name="tutor_id"  id="inputTutorId" class="form-control" placeholder="Ex:A000001" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" onclick="$('#newApplicationForm').submit()" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <script>
          function loadDataToNoteModal(el){
            el=$(el);
            $("#inputNoteId").val(el.data('id'));
            $("#inputNoteText").text(el.data('note'));
          }
      </script>
@endsection
@push('bottom')
<script>
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
            $("#location_id").html(html);
            $("#location_id").select2();
            $("#location_id").select2();

        }
        function tutorCityChanged(obj){
            var city=getCity($(obj).val());
            var html="";
            for(var loc of city.locations){
                html+=`<option value="`+loc.id+`" data-select2-id="`+loc.id+`">`+loc.name+`</option>`;
            }
            $("#tutor_location_id").html(html);
            $("#tutor_location_id").select2();
            $("#tutor_location_id").select2();
        }
            $(".select2").select2();

</script>
    
@endpush