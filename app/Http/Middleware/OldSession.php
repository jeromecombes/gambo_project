<?php

namespace App\Http\Middleware;

use Closure;

class OldSession
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

        if (php_sapi_name() === 'cli') {
            return $next($request);
        }

        // Check if session exists (old system)
        session_start();

        if (!empty($_SESSION['vwpp']['student']) and empty(session('student'))) {
            $request->session()->put('student', $_SESSION['vwpp']['student']);
        }

        if (!empty($_SESSION['vwpp']['semester'])) {
            $request->session()->put('semester', $_SESSION['vwpp']['semester']);
        }

        return $next($request);
    }
}
