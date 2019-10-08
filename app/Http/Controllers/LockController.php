<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockController extends Controller
{
    /**
     * Lock housing forms
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lock(Request $request)
    {
        $students = $request->students;
        $semester = $request->session()->get('semester');

        foreach ($students as $student) {
            $model = new $this->model;
            $model->firstOrCreate(['semester' => $semester, 'student' => $student]);
        }

        return redirect('/admin/students')->with('success', 'Update successful');
    }

    /**
     * Unlock housing forms
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unlock(Request $request)
    {
        $students = $request->students;
        $semester = $request->session()->get('semester');

        $model = new $this->model;
        $model->where('semester', $semester)
            ->whereIn('student', $students)
            ->delete();

        return redirect('/admin/students')->with('success', 'Update successful');
    }
}
