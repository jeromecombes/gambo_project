<?php

namespace App\Http\Middleware;

use Closure;

class OldSemester
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
        $semester = null;

        if (!empty($_SESSION['vwpp']['semestre'])) {
            $semester = $_SESSION['vwpp']['semestre'];
        }

        if ($semester) {
            $request->session()->put('semester', $semester);
        }

        return $next($request);
    }
}
