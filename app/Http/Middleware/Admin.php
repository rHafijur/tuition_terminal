<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $role=auth()->user()->cb_roles_id;
        if($role==1 || $role==2){
            return $next($request);
        }
        if($role==3){
            return redirect()->route('tutor_dashboard');
        }
        if($role==4){
            return redirect()->route('parent.dashboard');
        }
        return  redirect()->back();
    }
}
