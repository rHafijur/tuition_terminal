<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->cb_roles_id==3){
            return \redirect()->route('tutor_dashboard');
        }
        if(auth()->user()->cb_roles_id==4){
            return \redirect()->route('parent.dashboard');
        }
        return view('home');
    }
}
