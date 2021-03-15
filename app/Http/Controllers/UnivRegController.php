<?php

namespace App\Http\Controllers;

use App\Dates;
use App\FinalReg;
use App\Student;
use App\UnivReg;
use App\UnivReg2;
use App\UnivRegLock;
use App\UnivRegShow;
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

        // Get univ registration
        $final_reg = FinalReg::findMeOne();
        $university = $final_reg ? $final_reg->university : null;

        // Check if Univ registration is locked
        $locked = UnivRegLock::findMeOne() ? true : false;

        // Check if Univ registration is published
        $published = UnivRegShow::findMeOne() ? true : false;

        // Get student form
        $univ_reg = UnivReg::findMe();

        $answer = array();
        for ($i=0; $i <= 25; $i++) {
            $answer[$i] = null;
        }
        foreach ($univ_reg as $elem) {
            $answer[$elem->question] = $elem->response;
        }

        // Get student extra form (before 2019)
        $univ_reg_plus = UnivReg2::findMe();

        $answer_plus = array();
        for ($i=0; $i <= 16; $i++) {
            $answer_plus[$i] = null;
        }
        foreach ($univ_reg_plus as $elem) {
            $answer_plus[$elem->question] = $elem->response;
        }

        // Get deadlines
        $dates = Dates::where('semester', session('semester'))->first();

        // View
        return view('univ_reg.student_form', compact('edit', 'student', 'published', 'locked', 'dates', 'university', 'answer', 'answer_plus', 'countries', 'states'));
    }

}
