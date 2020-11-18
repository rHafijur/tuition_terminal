@extends('tutor.layouts.master',['title'=>'Payments'])

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- <div class="card-header">
            <h3 class="card-title">Payment Information for Verify Request</h3>
        </div> --}}
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <table class="table">
                <thead>
                   <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Payment For</th>
                    <th>thansaction Id</th>
                    <th>Sent From</th>
                    <th>Sent To</th>
                    <th>Confirmed</th>
                    <th>Action</th>
                   </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{$payment->id}}</td>
                        <td>৳{{$payment->amount}}</td>
                        <td>{{$payment->method}}</td>
                        <td>{{$payment->payment_for()}}</td>
                        <td>{{$payment->transaction_id}}</td>
                        <td>{{$payment->sent_from}}</td>
                        <td>{{$payment->sent_to}}</td>
                        <td>
                            @if($payment->confirmed==0)
                                No
                            @else
                                Yes
                            @endif
                        </td>
                        <td>
                            <a href="{{route('tutor_invoice',['id' => $payment->id])}}"><button class="btn btn-info">Invoice</button></a>
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