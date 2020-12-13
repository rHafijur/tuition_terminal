@extends('tutor.layouts.master',['title'=>'Payment Type'])

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- <div class="card-header">
            <h3 class="card-title">Payment Information for Verify Request</h3>
        </div> --}}
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="accordion" id="accordionPaymentType">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="nav-icon fas fa-equals"></i> &nbsp;&nbsp; <small>Payment for</small> <br> <strong>Tuition Matching</strong>
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionPaymentType">
                    <div class="card-body">
                        For matching any confirmed Job you have to pay 60% service charge of the specified job.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="nav-icon fas fa-user-check"></i> &nbsp;&nbsp; <small>Payment for</small> <br> <strong>Verification</strong>
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionPaymentType">
                    <div class="card-body">
                        For being verified you have to pay 300 TK service charge.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="nav-icon fas fa-id-card"></i> &nbsp;&nbsp; <small>Payment for</small> <br> <strong>Premium Membership</strong>
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionPaymentType">
                    <div class="card-body">
                        For the premium member you have to pay 480 Tk service charge.

                    </div>
                  </div>
                </div>
              </div>
        
        </div>
        <div class="row">
            <div class="col-md-6" style="margin: auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">We Accept</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="d-flex flex-column">
                                    <img style="display: block" src="{{asset('img/bkash.png')}}" alt="bkash logo" width="170px">
                                    <span class="text-muted" style="font-size: 20px">Bkash Merchant</span>
                                    <span style="font-size: 30px">01728611186</span>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="d-flex flex-column">
                                    <img style="display: block" src="{{asset('img/bkash.png')}}" alt="bkash logo" width="170px">
                                    <span class="text-muted" style="font-size: 20px">Bkash Personal</span>
                                    <span style="font-size: 30px">01715930910</span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:40px">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="d-flex flex-column">
                                    <img style="display: block" src="{{asset('img/nogod.png')}}" alt="nagad logo" width="170px">
                                    <span class="text-muted" style="font-size: 20px">Nagad Personal</span>
                                    <span style="font-size: 30px">01715930910</span>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="d-flex flex-column">
                                    <img style="display: block" src="{{asset('img/rocket.png')}}" alt="rocket logo" width="170px">
                                    <span class="text-muted" style="font-size: 20px">Rocket Personal</span>
                                    <span style="font-size: 30px">01715930910</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection