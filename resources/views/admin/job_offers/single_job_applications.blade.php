@extends(getThemePath('layout.layout'))
@section('content')
@push('head')
<link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
@endpush
@php
    use Carbon\Carbon;
    $is_super_admin=false;
    if (auth()->user()->cb_roles_id==1) {
        $is_super_admin=true;
    }
@endphp
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                Application List (Total:{{$offer->applications()->count()}})
            </h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addApplicationModal">+Add New</button>
            </div>
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
                        <th>Matched Rate</th>
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
                            <td> <a href="{{cb()->getAdminUrl("tutors/single/".$application->tutor->id)}}" target="_blank">
                                    {{$application->tutor->user->name}}
                                </a>
                                 {!!$application->tutor->getStatusIcon()!!}</td>
                            <td>{{$application->matched_rate()}}</td>
                            <td>
                                @if ($application->taken_by!=null)
                                {{$application->taken_by->name}}
                                @endif
                            </td>
                            <td>
                                @if ($application->taken_by==null)
                                    <a href="{{cb()->getAdminUrl("job_offers/application-take/".$application->id)}}"><button class="btn btn-info btn-sm">Take</button></a>
                                @else
                                    <button class="btn btn-info btn-sm">Taken</button>
                                @endif
                                <button type="button" class="btn btn-primary btn-sm" onclick="loadDataToNoteModal(this)" data-note="{{$application->note}}" data-id="{{$application->id}}" data-toggle="modal" data-target="#noteModal">Note</button>
                                @if ($is_super_admin)
                                <a href="{{cb()->getAdminUrl("job_offers/application-delete/".$application->id)}}"><button class="btn btn-danger btn-sm">Delete</button></a>
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
                    <input type="hidden" name="id" value="{{$offer->id}}">
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