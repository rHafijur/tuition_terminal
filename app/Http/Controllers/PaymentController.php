<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{
    public function all(){
        $payments=auth()->user()->payments;
        return view('tutor.payments',compact('payments'));
    }
    public function invoice($id){
        $payment=Payment::findOrFail($id);
        return view('tutor.invoice',compact('payment'));
    }
    public function types(){
        return view('tutor.payment_type');
    }
}
