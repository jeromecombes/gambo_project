<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
//         if (! $request->user()->hasRole($role)) {
//             // Redirect...
//         }

        // Don't check for students
        if (!session('admin')) {
            return $next($request);
        }

        if (!in_array($role, session('access'))) {
            return redirect()->route('admin.index')->with('warning', 'Access denied');
        }

        return $next($request);
    }

}