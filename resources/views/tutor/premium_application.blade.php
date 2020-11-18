@extends('tutor.layouts.master',['title'=>'Premium Membership Request'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            <h3 class="card-title">Payment Information for Premium Membership Request</h3>
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <form action="{{route('post_tutor_premium_request')}}" method="POST">
            @csrf
            <div class="form-group">
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
            </div>
            <button class="btn btn-success">Send Verify Request</button>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection