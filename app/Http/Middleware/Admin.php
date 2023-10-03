<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role == 1 ||  Auth::user()->role == 6){
                return $next($request);
            }else {
            toast('No Access Right','error');
                return redirect()->back();
            }
        }else {
            return redirect('/');
        }
    }
}
