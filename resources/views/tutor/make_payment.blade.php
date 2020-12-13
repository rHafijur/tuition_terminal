@extends('tutor.layouts.master',['title'=>'Make Payment'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            <h3 class="card-title">Make Payment</h3>
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <form action="{{route('tutor_save_payment')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Payment For</label>
                <select name="payment_for" class="form-control" required>
                    <option value="">Select Payment For</option>
                    <option value="Tuition Matching">Tuition Matching</option>
                    <option value="Verification">Verification</option>
                    <option value="Premium Membership">Premium Membership</option>
                </select>
            </div>
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