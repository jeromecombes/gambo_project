<?php

namespace App\Http\Controllers;

use App\Helpers\CourseHelper;
use App\Models\Evaluation;
use App\Models\Internship;
use App\Models\Tutoring;
use App\Models\RHCourse;
use App\Models\UnivCourse;
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
            'internship' => count($evaluations->where('form', 'internship')->where('closed', 1)),
            'linguistic' => count($evaluations->where('form', 'linguistic')->where('closed', 1)),
            'method' => count($evaluations->where('form', 'method')->where('closed', 1)),
            'program' => count($evaluations->where('form', 'program')->where('closed', 1)),
            'tutoring' => count($evaluations->where('form', 'tutoring')->where('closed', 1)),
            'local' => array(),
            'univ' => array(),
        );

        // Get closed evaluations for local courses
        foreach ($courses->local as $course) {
            $closed->local[$course->id] = count($evaluations->where('form', 'local')->where('courseId', $course->id)->where('closed', 1));
        }

        // Get closed evaluations for university courses
        foreach ($courses->univ as $course) {
            $closed->univ[$course->id] = count($evaluations->where('form', 'univ')->where('courseId', $course->id)->where('closed', 1));
        }

        // View
        return view('evaluations.index', compact('closed', 'courses', 'internship', 'tutoring'));
    }


    /**
     * Show evaluation form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request)
    {
        $edit = false;

        $form = $request->form;

        // Initialisation of $data
        $data = array();
        for ($i = 0; $i < 60; $i++) {
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
            $course_id = $request->id ?? 0;

            $evaluation = Evaluation::where('form', $form)
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


        switch ($form) {
            case 'linguistic' :
                $view = (object) array(
                    'course_id' => 0,
                    'form' => $form,
                    'title' => 'Ateliers Linguistiques',
                    'subtitle' => "La grammaire et syntaxe, la phonétique, l'interculturel",
                );

                return view('evaluations.workshop', compact('data', 'edit', 'view'));

                break;

            case 'local' :
                if ($edit) {
                    $course = RHCourse::find($course_id);
                    $data[1] = $course->name;
                    $data[2] = $course->professor;
                }

                $view = (object) ['course_id' => $course_id, 'form' => $form, 'title' => 'VWPP Course Evaluation'];
                return view('evaluations.local', compact('data', 'edit', 'view'));

                break;

            case 'internship' :
                $view = (object) ['course_id' => 0, 'form' => $form, 'title' => 'Internship Evaluation'];
                return view('evaluations.internship', compact('data', 'edit', 'view'));

                break;

            case 'method' :
                $view = (object) array(
                    'course_id' => 0,
                    'form' => $form,
                    'title' => 'Ateliers Méthodologiques',
                    'subtitle' => "La dissertation, le commentaire composé, l'exposé oral",
                );

                return view('evaluations.workshop', compact('data', 'edit', 'view'));

                break;

            case 'program' :
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

                $view = (object) ['course_id' => 0, 'form' => $form, 'title' => 'Program Evaluation'];
                return view('evaluations.program', compact('data', 'edit', 'view'));

                break;

            case 'tutoring' :
                if ($edit) {
                    $tutoring = Tutoring::findMe();
                    $data[1] = $tutoring->professor;
                }

                $view = (object) ['course_id' => 0, 'form' => $form, 'title' => 'Tutoring Evaluation'];
                return view('evaluations.tutoring', compact('data', 'edit', 'view'));

                break;

            case 'univ' :
                if ($edit) {
                    $course = UnivCourse::find($course_id);
                    $data[1] = $course->name;
                    $data[2] = $course->professor;
                    $data[3] = $course->institution;
                    $data[4] = $course->code;
                }

                $view = (object) ['course_id' => $course_id, 'form' => $form, 'title' => 'University Course Evaluation'];
                return view('evaluations.univ', compact('data', 'edit', 'view'));

                break;
        }
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
