<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Penilai
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
        if(!Auth::user()->role_id == 1){
            return redirect()->route('admin.dashboard');
        }
        if(!Auth::user()->role_id == 2){
            return redirect()->route('penilai.dashboard');
        }
        if(!Auth::user()->role_id == 3){
            return redirect()->route('dosen.dashboard');
        }
        return $next($request);
    }
}
