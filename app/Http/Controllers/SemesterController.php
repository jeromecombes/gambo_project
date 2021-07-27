<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session as Session;

class SemesterController extends Controller
{

    /**
     * Show select semester form for students
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $semesters = session('semesters');

        // View
        return view('semester.index', compact('semesters'));
    }

    /**
     * Update semester
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Session::put('semester', $request->semester);

        return redirect('/');
    }

}
