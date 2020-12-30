@php
    $stages=[
        'waiting',
        'meet',
        'trial',
        'confirm',
        'payment',
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
                                <select class="form-control" style="max-width: 100px">
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
    <script>
        function loadDataToNoteModal(el){
          el=$(el);
          $("#inputNoteId").val(el.data('id'));
          $("#inputNoteText").text(el.data('note'));
        }
    </script>
@endsection