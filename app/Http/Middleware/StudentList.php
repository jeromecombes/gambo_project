<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;

class StudentList
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

        if (!$user->admin) {
            return $next($request);
        }

        // Student list
        if (session('students')) {
            $students = session('students');
            $key = array_search(session('student'), $students);
            $student_previous = array_key_exists($key-1, $students) ? $students[$key-1] : null;
            $student_next = array_key_exists($key+1, $students) ? $students[$key+1] : null;
            $request->session()->put('student_previous', $student_previous);
            $request->session()->put('student_next', $student_next);
        }

        return $next($request);
    }
}
