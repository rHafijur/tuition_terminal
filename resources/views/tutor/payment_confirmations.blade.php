@extends('tutor.layouts.master',['title'=>'Invoices'])

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="row">
    <div class="col-md-12">

        {{-- <div class="card-header">
            <h3 class="card-title">Payment Information for Verify Request</h3>
        </div> --}}
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="list-group">
                @if ($payments->count()==0)
                    No Invoice
                @else
                    @foreach ($payments as $payment)
                    <a href="{{route('tutor_invoice_download',['id'=>$payment->id])}}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">InVoice Payment Confirmation</h5>
                        <small>{{Carbon::parse($payment->created_at)->toFormattedDateString()}}</small>
                        </div>
                        <small>Download</small>
                    </a>
                    @endforeach
                @endif

              </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection