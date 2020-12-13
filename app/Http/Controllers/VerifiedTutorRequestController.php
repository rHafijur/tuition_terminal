<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\VerifiedTutorRequest;
class VerifiedTutorRequestController extends Controller
{
    function create(){
        return view("tutor.verify_application");
    }
    function create_payment(Request $request){
        $user=auth()->user();
        // $payment= Payment::create([
        //     'user_id' => $user->id,
        //     'method' => $request->method,
        //     'transaction_id' => $request->transaction_id,
        //     'sent_from' => $request->sent_from,
        //     'sent_to' => $request->sent_to,
        //     'amount' => $request->amount,
        // ]);
        VerifiedTutorRequest::create([
            'tutor_id' => $user->tutor->id,
            // 'payment_id' => $payment->id,
        ]);

        return redirect()->back()->with('success','Request sent successfully');
        // return redirect()->route('tutor_invoice',['id' => $payment->id]);
    }
}
