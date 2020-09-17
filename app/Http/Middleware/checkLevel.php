<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class checkLevel
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
        if ( Auth::user()->level != 1 ) {
            abort(404);
        }
        return $next($request);
    }
}
