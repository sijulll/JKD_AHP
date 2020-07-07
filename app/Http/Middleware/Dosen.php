<?php

namespace App\Http\Middleware;

use Closure;

class Dosen
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
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(!Auth::user()->role_id == 3){
            return redirect()->route('dosen.dashboard');
        }
        return $next($request);
    }
}
