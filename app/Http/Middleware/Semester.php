<?php

namespace App\Http\Middleware;

use Closure;

class Semester
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

        if (empty(session('semester'))) {
            return redirect()->route('admin.index')->with('warning', 'Please, select a semester');
        }

        return $next($request);
    }
}
