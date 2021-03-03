<?php

namespace App\Http\Middleware;

use Closure;
use App\Student;

class OldStudent
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
        $student = null;
        if ($request->student) {
            $student = $request->student;
        } elseif (session('student')) {
            $student = session('student');
        } elseif (!empty($_SESSION['vwpp']['student'])) {
            $student = $_SESSION['vwpp']['student'];
        }

        if ($student) {
            $request->session()->put('student', $student);
            $request->session()->put('student_name', Student::find($student)->full_name);
        }

        return $next($request);
    }
}
