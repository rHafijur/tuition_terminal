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
            $.get('{{cb()->getAdminUrl("job_offers/offer-current-condition")}}'+'/'+id,function(data,status){
                if(status=="success"){
                    $("#currentConditionModalBody").html(data);
                }else{
                    $("#currentConditionModalBody").html("Something went wrong, please try again");
                }
            });
        }
    </script>
    
@endpush