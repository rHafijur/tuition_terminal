@extends(getThemePath('layout.layout'))
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
                            <td>{{$offer->id}}</td>
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
                                {{$offer->applications->count()}}
                            </td>
                            <td>
                                <input onchange="activeChanged(this,{{$offer->id}})" type="checkbox" {{$checked}} data-toggle="toggle">
                            </td>
                            <td>Action</td>
                        </tr>                         
                        @endforeach
                    </tbody>
                </table>
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
    </script>
    
@endpush