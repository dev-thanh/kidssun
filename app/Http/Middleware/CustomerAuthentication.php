<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class CustomerAuthentication
{
    protected $guards = [];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next, ...$guards)
    {
        if(!Auth::guard('customer')->check()){
            return redirect()->route('home.index');
        }

        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

}
