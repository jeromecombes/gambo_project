<?php

namespace App\Http\Middleware;

use Closure;

class OldAdmin
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
        
        if (empty($_SESSION['vwpp']['category']) or $_SESSION['vwpp']['category'] != 'admin') {
            return redirect('/');
        }

        $request->session()->put('admin', true);

        return $next($request);
    }
}
