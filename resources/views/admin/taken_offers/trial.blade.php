@php
    $stages=[
        'waiting',
        'meet',
        'trial',
        'confirm',
        'repost',
        'cancel',
    ];
    $is_sa=false;
    if(auth()->user()->cb_roles_id==1){
        $is_sa=true;
    }
    use Carbon\Carbon;
@endphp
@extends(getThemePath('layout.layout'))
@push('head')
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
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <ul id="tab_nav" class="nav nav-pills">
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers")}}" class="nav-link @if($stage=="")active @endif">Dashboard</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/waiting")}}" class="nav-link @if($stage=="waiting")active @endif">Waiting</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/meet")}}" class="nav-link @if($stage=="meet")active @endif">Meet</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/trial")}}" class="nav-link @if($stage=="trial")active @endif">Trial</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/confirm")}}" class="nav-link @if($stage=="confirm")active @endif">Confirm</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/due")}}" class="nav-link @if($stage=="due")active @endif">Due</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/payment")}}" class="nav-link @if($stage=="payment")active @endif">Payment</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/repost")}}" class="nav-link @if($stage=="repost")active @endif">Repost</a></li>
                    <li class="nav-item"><a href="{{cb()->getAdminUrl("taken_offers/cancel")}}" class="nav-link @if($stage=="cancel")active @endif">Cancel</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$trial_cnt}}</h2>
                        <span>Total Trial</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$new_cnt}}</h2>
                        <span>New in</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="report-card card">
                        <h2>{{$today_cnt}}</h2>
                        <span>Today's Trial</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Dates</th>
                        <th>Tuition ID</th>
                        <th>Trial Date</th>
                        <th>Class</th>
                        <th>Location</th>
                        <th>Tutor's ID</th>
                        <th>Tutor's Name</th>
                        <th>Tutor's Phone</th>
                        <th>Remarks</th>
                        <th>Stages</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>
                                <button onclick="dateButtonClicked({{$application->id}})" class="btn btn-info btn-sm">View</button>
                            </td>
                            <td>
                                {{$application->job_offer_id}}
                            </td>
                            <td>
                                {{Carbon::parse($application->trial_date)->toDateString()}}
                            </td>
                            <td>
                                {{$application->job_offer->course->title}}
                            </td>
                            <td>
                                {{$application->job_offer->location->name}}, {{$application->job_offer->city->name}},
                            </td>
                            <td>
                                {{$application->tutor->tutor_id}}
                            </td>
                            <td>
                                <a href="{{cb()->getAdminUrl("tutors/single/".$application->tutor->id)}}" target="_blank">
                                    {{$application->tutor->user->name}}
                                </a>
                            </td>
                            <td>
                                {{$application->tutor->user->phone}}
                            </td>
                            <td>
                                {{$application->tutor->reference_name}}
                            </td>
                            <td>
                                <select onchange="stageOptionChanged(this,{{$application->id}})" class="form-control" style="max-width: 100px">
                                    <option value="">Select</option>
                                    @foreach ($stages as $st)
                                    <option value="{{$st}}" @if($st==$application->current_stage) selected @endif>{{ucfirst($st)}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" onclick="loadDataToCurrentConditoinModal({{$application->job_offer->id}})" data-toggle="modal" data-target="#currentConditionModal">Condition</button>
                                @if ($is_sa)
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                @endif
                                <button type="button" class="btn btn-primary btn-sm" onclick="loadDataToNoteModal(this)" data-note="{{$application->note}}" data-id="{{$application->id}}" data-toggle="modal" data-target="#noteModal">Note</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.taken_offers.src.modals');
@endsection