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

        // Admin : set session student = request->student
        if ($user->admin and $request->student) {
            $request->session('student')->put($request->student);
        }

        // Student : force request->student = session student
        if (!$user->admin and $request->student) {
            $request->student = session('student');
        }

        return $next($request);
    }
}
