<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function tutorIndex(){
        // dd(auth()->user()->notifications->count());
        $notifications=auth()->user()->notifications()->latest()->paginate(10);
        return view('tutor.notification',compact('notifications'));
    }
}
