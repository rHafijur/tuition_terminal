@extends(getThemePath('layout.layout'))
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> All Premium Membership Requests</h1>
        </div>
        <div class="box-body"> 
            <table class="table">
                <thead>
                    <tr>
                        <th>Tutor Id</th>
                        <th>Name</th>
                        <th>Paid</th>
                        <th>Transaction Id</th>
                        <th>Payment Status</th>
                        <th>Request Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>
                                <a href="{{url('admin/tutors/single/'.$request->tutor->id)}}">{{$request->tutor->tutor_id}}</a>
                            </td>
                            <td>
                                <a href="{{url('admin/tutors/single/'.$request->tutor->id)}}">{{$request->tutor->user->name}}</a>
                            </td>
                            <td>{{$request->payment->amount}}</td>
                            <td>{{$request->payment->transaction_id}}</td>
                            <td>{{$request->payment->confirmed==1?'Confirmed':'Pending'}}</td>
                            <td>
                                @if ($request->status== -1)
                                    Pending
                                @elseif($request->status== 0)
                                    Declined
                                @else
                                    Granted
                                @endif
                            </td>
                            <td>
                                @if ($request->status== -1)
                                <a href="{{url('admin/verified_tutor_requests/grant/'.$request->id)}}">
                                    <button class="btn btn-success">Grant</button>
                                </a>
                                <button class="btn btn-danger" onclick="setId({{$request->id}})" data-toggle="modal" data-target="#decline">
                                    Decline
                                </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  
  <!-- Modal -->
  <div class="modal fade" id="decline" tabindex="-1" aria-labelledby="declineLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="declineLabel">Enter Decline Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/verified_tutor_requests/decline')}}" method="post">
                @csrf
                <input type="hidden" name="id" id="req_id">
                <div class="form-group">
                    <label>Note</label>
                    <textarea class="form-control" name="message" rows="5" required></textarea>
                </div>
                <button class="btn btn-danger">Decline</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script>
      function setId(id){
          document.getElementById('req_id').value=id;
      }
  </script>
@endsection