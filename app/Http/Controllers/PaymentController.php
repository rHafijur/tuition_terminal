<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use PDF;

class PaymentController extends Controller
{
    public function all(){
        $payments=auth()->user()->payments;
        return view('tutor.payments',compact('payments'));
    }
    public function confirmed(){
        $payments=auth()->user()->payments()->where('confirmed',1)->orderBy('id','desc')->get();
        return view('tutor.payment_confirmations',compact('payments'));
    }
    public function invoice($id){
        $payment=Payment::findOrFail($id);
        return view('tutor.invoice',compact('payment'));
    }
    public function invoice_download($id){
        $payment=Payment::findOrFail($id);
        $pdf = PDF::loadView('tutor.invoice_download',compact('payment'));
        return $pdf->download('tuition_terminal_invoice_'.$id.'.pdf');
    }
    public function types(){
        return view('tutor.payment_type');
    }
    public function make(){
        return view('tutor.make_payment');
    }
    public function save(Request $request){
        $user=auth()->user();
        $payment= Payment::create([
            'user_id' => $user->id,
            'method' => $request->method,
            'payment_for' => $request->payment_for,
            'transaction_id' => $request->transaction_id,
            'sent_from' => $request->sent_from,
            'sent_to' => $request->sent_to,
            'amount' => $request->amount,
        ]);
        return redirect()->route('tutor_invoice',['id' => $payment->id]);
    }
}
