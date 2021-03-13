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
        // Check if session exists (old system)
        session_start();

        if (!empty($_SESSION['vwpp']['login_name'])) {
            $request->session()->put('login_name', $_SESSION['vwpp']['login_name']);
        }

        if (!empty($_SESSION['vwpp']['student'])) {
            $request->session()->put('student', $_SESSION['vwpp']['student']);
        }

        if (!empty($_SESSION['vwpp']['semester'])) {
            $request->session()->put('semester', $_SESSION['vwpp']['semester']);
        }

        if (empty($_SESSION['vwpp']['category'])) {
            return redirect('/');
        }

        return $next($request);
    }
}
