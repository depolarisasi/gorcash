<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Sales
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
            if(Auth::user()->role == 2 || Auth::user()->role == 4 || Auth::user()->role == 1){
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
