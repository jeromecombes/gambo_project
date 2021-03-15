<?php

namespace App\Http\Controllers;

use App\Student;
use App\Univ_reg3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as LaravelSession;

class UnivRegController extends Controller
{

    /**
     * Display the univ registration form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student_form(Request $request)
    {

        include_once( __DIR__ . '/../../../public/inc/states.inc');

        $edit = $request->edit;

        // Get student info
        $id = session('student');
        $student = Student::find($id);

        // TEST
        $locked = true;
        $published = true;
        $dates = array(
            'date5' => 'November 4, 2012',
            'date6' => 'November 4, 2012',
            'date7' => 'November 4, 2012',
            'date8' => 'November 4, 2012',
        );
        $university = false;
        for ($i = 1; $i <=22; $i++) {
            $answer[$i] = 'test';
        }
        for ($i = 0; $i <=16; $i++) {
            $answer_plus[$i] = 'test';
        }

        // View
        return view('univ_reg.student_form', compact('edit', 'student', 'published', 'locked', 'dates', 'university', 'answer', 'answer_plus', 'countries', 'states'));
    }

}
