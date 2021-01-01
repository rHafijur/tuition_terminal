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
@endphp
@extends(getThemePath('layout.layout'))

@section('content')
    <div class="card">
        <div class="card-header">
            <ul id="tab_nav" class="nav nav-pills">
                <li class="nav-item"><a href="" class="nav-link @if($stage=="")active @endif">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="waiting")active @endif">Waiting</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="meet")active @endif">Meet</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="trial")active @endif">Trial</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="confirm")active @endif">Confirm</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="payment")active @endif">Payment</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="repost")active @endif">Repost</a></li>
                <li class="nav-item"><a class="nav-link @if($stage=="cancel")active @endif">Cancel</a></li>
            </ul>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Dates</th>
                        <th>Tuition ID</th>
                        <th>Class</th>
                        <th>Location</th>
                        <th>Tutor's ID</th>
                        <th>Tutor's Name</th>
                        <th>Tutor's Phone</th>
                        <th>Stages</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>
                                <button class="btn btn-info btn-sm">View</button>
                            </td>
                            <td>
                                {{$application->job_offer_id}}
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
                                {{$application->tutor->user->name}}
                            </td>
                            <td>
                                {{$application->tutor->user->phone}}
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