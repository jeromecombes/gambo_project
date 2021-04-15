<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display admin index page (semester's selection)
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('semester');
        $request->session()->forget('student');
        $request->session()->forget('student_name');
        $request->session()->forget('student_next');
        $request->session()->forget('student_previous');
        $request->session()->forget('students');

        $oldestYear = date('Y') - 5;
        $semesters = array('' => '');
        for ($i = date('Y')+1; $i >= $oldestYear; $i--){
            $semesters["Fall $i"] = "Fall $i";
            $semesters["Spring $i"] = "Spring $i";
        }

        $semester = $request->semester;

        if (empty($semester) and !empty($_SESSION['vwpp']['semester'])) {
            $semester = $_SESSION['vwpp']['semester'];
        }

        return view('admin.index', compact('semesters', 'semester'));
    }

    /**
     * Set the semester
     *
     */
    public function semester(Request $request)
    {
        $request->session()->put('semester', $request->semester);
        $_SESSION['vwpp']['semester'] = $request->semester;
        $_SESSION['vwpp']['semestre'] = $request->semester;

        return redirect('/students');
    }

    /**
     * Set the student list (Ajax)
     *
     * @return \Illuminate\Http\Response
     */
    public function students(Request $request)
    {
        $list = $request->list;
        $list = $list ? json_decode($list) : null;

        $request->session()->put('students', $list);

        return json_encode('ok');
    }
}
