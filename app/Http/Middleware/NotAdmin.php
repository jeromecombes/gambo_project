<?php

namespace App\Http\Middleware;

use Closure;

class NotAdmin
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
            return redirect()->back()->with('warning', 'Access denied');
        }

        return $next($request);
    }
}
