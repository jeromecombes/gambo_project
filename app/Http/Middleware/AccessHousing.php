<?php

namespace App\Http\Middleware;

use Closure;

class AccessHousing
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

        if (!in_array(2, session('access'))) {
            return redirect('/')->with('warning', 'Access denied');
        }

        return $next($request);
    }
}
