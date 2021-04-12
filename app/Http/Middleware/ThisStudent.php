<?php

namespace App\Http\Middleware;

use Closure;

class ThisStudent
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

        if ($user->admin) {
            return $next($request);
        }

        if ($request->student != session('student')) {
            return redirect('/');
        }

        return $next($request);

    }
}
