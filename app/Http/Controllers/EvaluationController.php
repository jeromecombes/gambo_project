<?php

namespace App\Http\Controllers;

use App\Helpers\CourseHelper;
use App\Models\Evaluation;
use App\Models\Internship;
use App\Models\Tutoring;
use App\Models\RHCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EvaluationController extends Controller
{
    public function __construct()
    {
        App::setLocale('fr_FR');
    }

    /**
     * Show student's evaluations index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // Get Courses, internship and tutoring information
        $courses = CourseHelper::get();
        $internship = Internship::findOrCreateMe();
        $tutoring = Tutoring::findOrCreateMe();

        // Get closed evaluations
        $evaluations = Evaluation::getMe();

        $closed = (object) array(
            'intership' => count($evaluations->where('form', 'intership')->where('closed', 1)),
            'linguistic' => count($evaluations->where('form', 'linguistique')->where('closed', 1)),
            'method' => count($evaluations->where('form', 'method')->where('closed', 1)),
            'program' => count($evaluations->where('form', 'program')->where('closed', 1)),
            'tutoring' => count($evaluations->where('form', 'tutorats')->where('closed', 1)),
            'local' => array(),
            'univ' => array(),
        );

        // Get closed evaluations for local courses
        foreach ($courses->local as $course) {
            $closed->local[$course->id] = count($evaluations->where('form', 'ReidHall')->where('courseId', $course->id)->where('closed', 1));
        }

        // Get closed evaluations for university courses
        foreach ($courses->univ as $course) {
            $closed->univ[$course->id] = count($evaluations->where('form', 'univ')->where('courseId', $course->id)->where('closed', 1));
        }

        // View
        return view('evaluations.index', compact('closed', 'courses', 'internship', 'tutoring'));
    }


    /**
     * Show local courses evaluation form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function course_form(Request $request)
    {
        $edit = false;

        // Initialisation of $data
        $data = array();
        for ($i = 0; $i < 33; $i++) {
            $data[$i] = null;
        }

        // Admin with ID
        if (session('admin')) {
            $evaluation = Evaluation::find($request->id);
            $course_id = $evaluation->courseId;

            foreach ($evaluation->links as $elem) {
                $data[$elem->question] = $elem->response;
            }

        // Student
        } else {
            $course_id = $request->id;

            $evaluation = Evaluation::where('form', 'ReidHall')
                ->where('semester', session('semester'))
                ->where('student', session('student'))
                ->where('courseId', $course_id)
                ->get();

            if (count($evaluation)) {
                foreach ($evaluation as $elem) {
                    $data[$elem->question] = $elem->response;
                }
            } else {
                $edit = true;
            }
        }

        $view = (object) ['course_id' => $course_id, 'form' => 'ReidHall', 'title' => 'VWPP Course Evaluation'];

        $course = RHCourse::find($course_id);

        // View
        return view('evaluations.course', compact('course', 'data', 'edit', 'view'));
    }

    /**
     * Show program evaluation form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function program_form(Request $request)
    {

        $edit = false;
        $view = (object) ['course_id' => 0, 'form' => 'program', 'title' => 'Program Evaluation'];

        // Initialisation of $data
        $data = array();
        for ($i = 0; $i < 57; $i++) {
            $data[$i] = null;
        }

        // Admin with ID
        if (session('admin') and $request->id) {
            $evaluation = Evaluation::find($request->id);

            foreach ($evaluation->links as $elem) {
                $data[$elem->question] = $elem->response;
            }

        // Student
        } else {
            $evaluation = Evaluation::where('form', 'program')
                ->where('semester', session('semester'))
                ->where('student', session('student'))
                ->get();

            if (count($evaluation)) {
                foreach ($evaluation as $elem) {
                    $data[$elem->question] = $elem->response;
                }
            } else {
                $edit = true;
            }
        }

        if (!empty($data[32])) {

            // TODO : When evaluations of Spring 2020 and before will be removed : Keep only $data[32] = json_decode($data[32]);

            $tmp = json_decode($data[32]);
            if (json_last_error() == JSON_ERROR_NONE) {
                $data[32] = $tmp;
            } else {
                $data[32] = unserialize($data[32]);
            }

            $data[32] = is_array($data[32]) ? join(' ; ', $data[32]) : null;
        }

        // View
        return view('evaluations.program', compact('data', 'edit', 'view'));
    }


    /**
     * Update an evaluation form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $timestamp = time();

        foreach ($request->data as $question => $answer) {
            $evaluation = new Evaluation();
            $evaluation->student = session('student');
            $evaluation->form = $request->form;
            $evaluation->courseId = $request->course_id;
            $evaluation->timestamp = $timestamp;
            $evaluation->question = $question;
            $evaluation->response = $answer;
            $evaluation->closed = '1';
            $evaluation->semester = session('semester');
            $evaluation->save();
        }

        return redirect()->route('evaluations.index')->with('success', 'Your evaluation has been saved. Thanks !');
    }

}
