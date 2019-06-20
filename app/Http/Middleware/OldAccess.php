<?php

namespace App\Http\Middleware;

use Closure;

class OldAccess
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
        $request->session()->put('access', $_SESSION['vwpp']['access']);
        return $next($request);
    }
}
