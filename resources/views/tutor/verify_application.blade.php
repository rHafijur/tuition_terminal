@extends('tutor.layouts.master',['title'=>'Verify Tutor Request'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            <h3 class="card-title">Apply for Verification</h3>
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima dicta labore dolorum officia. Adipisci ad reiciendis dolorum maiores error optio quidem eum. Natus dicta quidem animi incidunt cupiditate sed dolor?
          <form action="{{route('post_tutor_verify_request')}}" method="POST">
            @csrf
            {{-- <div class="form-group">
                <label>Transaction Method</label>
                <select name="method" class="form-control" required>
                    <option value="">Select Payment Method</option>
                    <option value="Bkash">Bkash</option>
                    <option value="Rocket">Rocket</option>
                </select>
            </div>
            <div class="form-group">
                <label>Transaction Id</label>
                <input class="form-control" type="text" name="transaction_id" required>
            </div>
            <div class="form-group">
                <label>Sent From <small>Optional</small></label>
                <input class="form-control" type="text" name="sent_from" placeholder="016XXXXXXXX">
            </div>
            <div class="form-group">
                <label>Sent To <small>Optional</small></label>
                <input class="form-control" type="text" name="sent_to" placeholder="016XXXXXXXX">
            </div>
            <div class="form-group">
                <label>Amount (taka)</label>
                <input class="form-control" type="number" name="amount" required>
            </div>
            <div class="form-group">
                <label>Note <small>Optional</small></label>
                <input class="form-control" type="text" name="note">
            </div> --}}
            @if (auth()->user()->tutor->verified_tutor_requests->count()>0)
            <button disabled class="btn btn-success disabled">Already Applied</button>
            @else
            <button class="btn btn-success">Apply for Verification</button>
            @endif
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection