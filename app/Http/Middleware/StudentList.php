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
        // Using old session
        if (!empty($_SESSION["vwpp"]["studentsList"])) {
            $students_list = $_SESSION["vwpp"]["studentsList"];
            $request->session()->put('students_list', $students_list);

            $key = array_search(session('student'), $students_list);
            $student_previous = array_key_exists($key-1, $students_list) ? $students_list[$key-1] : null;
            $student_next = array_key_exists($key+1, $students_list) ? $students_list[$key+1] : null;
            $request->session()->put('student_previous', $student_previous);
            $request->session()->put('student_next', $student_next);
        }

        return $next($request);
    }
}
