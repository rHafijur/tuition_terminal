@extends('layouts.app')

@push('css')
    <style>
        #wrapper {
        font-family: Lato;
        font-size: 1.5rem;
        text-align: center;
        box-sizing: border-box;
        color: #333;
        
        #dialog {
            border: solid 1px #ccc;
            margin: 10px auto;
            padding: 20px 30px;
            display: inline-block;
            box-shadow: 0 0 4px #ccc;
            background-color: #FAF8F8;
            overflow: hidden;
            position: relative;
            max-width: 450px;
            
            h3 {
            margin: 0 0 10px;
            padding: 0;
            line-height: 1.25;
            }
            
            span {
            font-size: 90%;
            }
            
            #form {
            max-width: 240px;
            margin: 25px auto 0;
            
            input {
                margin: 0 5px;
                text-align: center;
                line-height: 80px;
                font-size: 50px;
                border: solid 1px #ccc;
                box-shadow: 0 0 5px #ccc inset;
                outline: none;
                width: 20%;
                transition: all .2s ease-in-out;
                border-radius: 3px;
                
                &:focus {
                border-color: purple;
                box-shadow: 0 0 5px purple inset;
                }
                
                &::selection {
                background: transparent;
                }
            }
            
            button {
                margin:  30px 0 50px;
                width: 100%;
                padding: 6px;
                background-color: #B85FC6;
                border: none;
                text-transform: uppercase;
            }
            }
            
            button {
            &.close {
                border: solid 2px;
                border-radius: 30px;
                line-height: 19px;
                font-size: 120%;
                width: 22px;
                position: absolute;
                right: 5px;
                top: 5px;
            }           
            }
            
            div {
            position: relative;
            z-index: 1;
            }
            
            img {
            position: absolute;
            bottom: -70px;
            right: -63px;
            }
        }
        }
    </style>
@endpush

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Mobile number') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A six digit verification code has been sent to your mobile number.') }}
                        </div>
                    @endif
                    <form action="{{route('otp.verify')}}">
                        @csrf
                        <div class="form-group">
                            <input type="number" class="form-control" name="otp">
                        </div>
                    </form>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    @if (session('error'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
              </div>
        </div>
    </div>
    @endif
    @if (session('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                {{session('success')}}
              </div>
        </div>
    </div>
    @endif
    <div id="wrapper">
        <div id="dialog">
          <button class="close">×</button>
          <h3>Please enter the 6-digit verification code we sent via SMS:</h3>
          <span>OTP Sent to {{auth()->user()->phone}}</span>
          <form  action="{{route('otp.verify')}}" method="POST" id="otp_form">
            @csrf
            <input type="hidden" id="otp" name="otp">
        </form>
          <form  action="{{route('otp.resend')}}" method="POST" id="otp_resend">
            @csrf
        </form>
          <div id="form">
            <input class="otp" type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input class="otp" type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input class="otp" type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input class="otp" type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input class="otp" type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input class="otp" type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <button class="btn btn-primary btn-embossed" onclick="submit()">Verify</button>
          </div>
          
          <div>
            <div id="resend" style="display: none">
                Didn't receive the code?<br />
                <a href="#" onclick="resend()">Send code again</a><br />
            </div>
            <div id="timer">

            </div>
            {{-- <a href="#">Change phone number</a> --}}
          </div>
        </div>
      </div>
</div>
@endsection

@push('js')
<script src="{{asset('admin_lte/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $(function() {
  'use strict';

  var body = $('body');

  function goToNextInput(e) {
    var key = e.which,
      t = $(e.target),
      sib = t.next('input');

    if (key != 9 && (key < 48 || key > 57)) {
      e.preventDefault();
      return false;
    }

    if (key === 9) {
      return true;
    }

    if (!sib || !sib.length) {
      sib = body.find('input').eq(0);
    }
    sib.select().focus();
  }

  function onKeyDown(e) {
    var key = e.which;

    if (key === 9 || (key >= 48 && key <= 57)) {
      return true;
    }

    e.preventDefault();
    return false;
  }
  
  function onFocus(e) {
    $(e.target).select();
  }

  body.on('keyup', 'input', goToNextInput);
  body.on('keydown', 'input', onKeyDown);
  body.on('click', 'input', onFocus);
  var sec=30;
  var interval= window.setInterval(function (){
    if(sec-- == 0){
        clearInterval(interval);
        $("#resend").removeAttr("style");
        $("#timer").remove();
    }
    $("#timer").html("Please wait "+sec+" secound(s) before resending otp");
  }, 1000);

})
function submit(){
    var inps= $(".otp");
    var otp="";
    for(var inp of inps){
        otp+=inp.value;
    }
    // console.log(otp);
    if(otp.length<6){
        alert('Invalid OTP');
        return;
    }
    $("#otp").val(otp);
    $("#otp_form").submit();

}
function resend(){
    $("#otp_resend").submit();
}
</script>
    
@endpush
