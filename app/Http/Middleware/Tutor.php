<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Tutor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('login');
        }
        if(auth()->user()->cb_roles_id!=3){
            return redirect('login');
        }
        if(auth()->user()->phone_verified_at==null){
            return redirect()->route('otp');
        }
        return $next($request);
    }
}
