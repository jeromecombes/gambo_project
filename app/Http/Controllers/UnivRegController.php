<?php

namespace App\Http\Controllers;

use App\Models\Dates;
use App\Models\Student;
use App\Models\UnivReg;
use App\Models\UnivReg2;
use App\Models\UnivReg3;
use App\Models\UnivRegLock;
use App\Models\UnivRegShow;
use App\Helpers\CountryHelper;
use App\Helpers\StateHelper;
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

        $edit = $request->edit;

        // Get student info
        $student = Student::find(session('student'));

        // Get univ registration
        $univ_reg3 = UnivReg3::findMe();
        $university = $univ_reg3 ? $univ_reg3->university : null;

        // Check if Univ registration is locked
        $locked = UnivRegLock::findMe() ? true : false;

        // Check if Univ registration is published
        $published = UnivRegShow::findMe() ? true : false;

        // Get student form
        $univ_reg = UnivReg::getMe();

        $answer = array();
        for ($i=0; $i <= 25; $i++) {
            $answer[$i] = null;
        }
        foreach ($univ_reg as $elem) {
            $answer[$elem->question] = $elem->response;
        }

        // Get student extra form (before 2019)
        $univ_reg_plus = UnivReg2::getMe();

        $answer_plus = array();
        for ($i=0; $i <= 16; $i++) {
            $answer_plus[$i] = null;
        }
        foreach ($univ_reg_plus as $elem) {
            $answer_plus[$elem->question] = $elem->response;
        }

        // Get deadlines
        $dates = Dates::where('semester', session('semester'))->first();

        $states = StateHelper::get();
        $countries = CountryHelper::get();

        // View
        return view('univ_reg.student_form', compact('edit', 'student', 'published', 'locked', 'dates', 'university', 'answer', 'answer_plus', 'countries', 'states'));
    }

    /**
     * Update Final Univ Registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function univ_reg3_update(Request $request)
    {
        UnivReg3::updateOrCreate(
            array(
                'student' => session('student'),
                'semester' => session('semester'),
            ),
            array(
                'university' => $request->university,
            )
        );

        return redirect("/univ_reg")->with('success', 'Mise à jour réussie');
    }

    /**
     * Update Univ Reg
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function univ_reg_update(Request $request)
    {
        UnivReg::where('student', session('student'))
            ->where('semester', session('semester'))
            ->delete();

        foreach ($request->question as $question => $answer) {
            $univ_reg = new UnivReg();
            $univ_reg->student = session('student');
            $univ_reg->semester = session('semester');
            $univ_reg->question = $question;
            $univ_reg->response = $answer;
            $univ_reg->save();
        }

        return redirect("/univ_reg")->with('success', 'Mise à jour réussie');
    }

}
