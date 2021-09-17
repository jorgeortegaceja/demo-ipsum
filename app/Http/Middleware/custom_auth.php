<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class custom_auth
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

        if( $request->session()->has('authenticated')){
            return $next($request);
        }

        return redirect('/login');
    }
}