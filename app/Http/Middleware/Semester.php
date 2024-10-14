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
        $user = $request->user();

        if (empty(session('semester'))) {
            if ($user->admin) {
                return redirect()->route('project.index')->with('warning', 'Please, select a semester');
            } else {
                return redirect()->route('semester.index');
            }
        }

        return $next($request);
    }
}
