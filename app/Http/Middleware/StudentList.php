<?php

namespace App\Http\Middleware;

use Closure;
use App\Student;

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
        if (!session('admin')) {
            return $next($request);
        }

        // Current student
        $student = $request->student ?? session('student');

        if ($student) {
            $std = Student::find($student);
            $request->session()->put('student_name', $std->full_name);
            $request->session()->put('student', $student);
        }

        // Student list
        // Using old session
        if (!empty($_SESSION["vwpp"]["studentsList"])) {
            $students_list = $_SESSION["vwpp"]["studentsList"];
            $request->session()->put('students_list', $students_list);

            $key = array_search($student, $students_list);
            $student_previous = array_key_exists($key-1, $students_list) ? $students_list[$key-1] : null;
            $student_next = array_key_exists($key+1, $students_list) ? $students_list[$key+1] : null;
            $request->session()->put('student_previous', $student_previous);
            $request->session()->put('student_next', $student_next);
        }

        return $next($request);
    }
}
