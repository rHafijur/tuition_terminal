@extends(getThemePath('layout.layout'))
@section('content')
@push('head')
<link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
@endpush
@php
    use Carbon\Carbon;
@endphp
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                Application List (Total:{{$offer->applications()->count()}})
            </h3>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Job Id</th>
                        <td>{{$offer->id}}</td>
                        <td colspan="2">|</td>
                        <th scope="row">City</th>
                        <td>{{$offer->city->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Course</th>
                        <td>{{$offer->course->title}}</td>
                        <td colspan="2">|</td>
                        <th scope="row">Received Date</th>
                        <td>{{Carbon::parse($offer->created_at)->toDateString()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td>{{$offer->category->title}}</td>
                        <td colspan="2">|</td>
                        <th scope="row">Hiring Date</th>
                        <td>{{Carbon::parse($offer->hiring_from)->toDateString()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Salary Range</th>
                        <td>{{$offer->min_salary}} - {{$offer->max_salary}}</td>
                        <td colspan="2">|</td>
                        <th scope="row">Received By</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>{{$offer->phone}}</td>
                        <td colspan="2">|</td>
                        <th scope="row">Location</th>
                        <td>{{$offer->location->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Remarks</th>
                        <td>{{$offer->reference_name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Application ID</th>
                        <th>Job ID</th>
                        <th>Tutor Name</th>
                        <th>Taken By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offer->applications as $application)
                        @php
                            // dd($application->taken_by->name);
                        @endphp
                        <tr>
                            <td>{{Carbon::parse($application->created_at)->toDateString()}}</td>
                            <td>{{Carbon::parse($application->created_at)->toTimeString()}}</td>
                            <td>{{$application->id}}</td>
                            <td>{{$application->job_offer_id}}</td>
                            <td>{{$application->tutor->user->name}} {!!$application->tutor->getStatusIcon()!!}</td>
                            <td>
                                @if ($application->taken_by!=null)
                                {{$application->taken_by->name}}
                                @endif
                            </td>
                            <td>
                                @if ($application->taken_by==null)
                                    <a href="{{cb()->getAdminUrl("job_offers/application-take/".$application->id)}}"><button class="btn btn-info">Take</button></a>
                                @else
                                    <button class="btn btn-info">Taken</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection