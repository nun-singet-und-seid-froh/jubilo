<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class RedirectIfConfirmed
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
        if ( Auth::user() and Auth::user()->roles()->get()->count() > 0 ) { // user has no role, so she's unconfirmed
            return $next($request);
        }
        return redirect('permission');

    }
}
