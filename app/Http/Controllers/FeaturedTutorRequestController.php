<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\FeaturedTutorRequest;
class FeaturedTutorRequestController extends Controller
{
    function create(){
        return view("tutor.featured_application");
    }
    function create_payment(Request $request){
        $user=auth()->user();
        $payment= Payment::create([
            'user_id' => $user->id,
            'method' => $request->method,
            'transaction_id' => $request->transaction_id,
            'sent_from' => $request->sent_from,
            'sent_to' => $request->sent_to,
            'amount' => $request->amount,
        ]);
        FeaturedTutorRequest::create([
            'tutor_id' => $user->tutor->id,
            'payment_id' => $payment->id,
        ]);


        return redirect()->route('tutor_invoice',['id' => $payment->id]);
    }
}
