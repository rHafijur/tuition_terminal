<?php

namespace App\Http\Middleware;

use Closure;

class ParentHasAnOffer
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
        $cnt= auth()->user()->parents->job_offers->count();
        if($cnt==0){
            return redirect()->route('parent.init_offer_form');
        }
        return $next($request);
    }
}
