<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Session;
use Illuminate\Support\Facades\Session as LaravelSession;

class AdminController extends Controller
{
    /**
     * Display admin index page (semester's selection)
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        LaravelSession::forget('semester');
        LaravelSession::forget('student');

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
}