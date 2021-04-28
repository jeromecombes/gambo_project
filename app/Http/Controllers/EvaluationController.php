<?php

namespace App\Http\Controllers;

use App\Helpers\CourseHelper;
use App\Helpers\EvaluationHelper;
use App\Models\Evaluation;
use App\Models\EvaluationEnabled;
use App\Models\Internship;
use App\Models\Tutoring;
use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use App\Models\Student;
use App\Models\UnivCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EvaluationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('semester');
        $this->middleware('role:15')->except('who');

        $this->middleware('admin')->only(['home', 'list', 'table', 'who']);
        $this->middleware('not.admin')->only(['index', 'update']);
        $this->middleware('role:22')->only('who');

        App::setLocale('fr_FR');
    }

    /**
     * Enable or disable evaludations
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request)
    {

        $evaluation = EvaluationEnabled::where('semester', session('semester'))->first();

        if ($evaluation) {
            $evaluation->delete();
            $result = ['button-value' => 'Enable evaluations'];
        } else {
            EvaluationEnabled::create(['semester' => session('semester')]);
            $result = ['button-value' => 'Disable evaluations'];
        }

        return json_encode($result);
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
        $user = auth()->user();

        $edit = false;

        $form = $request->form;

        // Initialisation of $data
        $data = array();
        for ($i = 0; $i < 60; $i++) {
            $data[$i] = null;
        }

        // Admin
        if ($user->admin) {
            $evaluation = Evaluation::find($request->id);
            $course_id = $evaluation->courseId;
            $student = $evaluation->student;

            foreach ($evaluation->links as $elem) {
                $data[$elem->question] = $elem->response;
            }

        // Student
        } else {
            $course_id = $request->id ?? 0;
            $student = session('student');

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
                $course = RHCourse::find($course_id);
                $data[1] = $course->name;
                $data[2] = $course->professor;

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
                $tutoring = Tutoring::where('semester', session('semester'))
                    ->where('student', $student)
                    ->first();

                $data[1] = $tutoring->professor ?? null;

                $view = (object) ['course_id' => 0, 'form' => $form, 'title' => 'Tutoring Evaluation'];
                return view('evaluations.tutoring', compact('data', 'edit', 'view'));

                break;

            case 'univ' :
                $course = UnivCourse::find($course_id);
                $data[1] = $course->name;
                $data[2] = $course->professor;
                $data[3] = $course->institution;
                $data[4] = $course->code;

                $view = (object) ['course_id' => $course_id, 'form' => $form, 'title' => 'University Course Evaluation'];
                return view('evaluations.univ', compact('data', 'edit', 'view'));

                break;
        }
    }

    /**
     * Display the admin home page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $user = auth()->user();

        $evaluations_enabled = EvaluationEnabled::where('semester', session('semester'))->first();

        return view('evaluations.home', compact('evaluations_enabled'));
    }

    /**
     * Display the list of filled evaluations
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $form = $request->form;

        // Evaluations
        $students = Student::findMine('id');

        $evaluations = Evaluation::where('semester', session('semester'))
            ->whereIn('student', $students)
            ->where('form', $form)
            ->groupBy('timestamp')
            ->get();

        if ($form == 'local') {
            $courses = RHCourse::where('semester', session('semester'))->get();
            foreach ($evaluations as $k => $v) {
                $course = $courses->find($v->courseId);
                $evaluations[$k]['course'] = $course->name ?? null;
                $evaluations[$k]['professor'] = $course->professor ?? null;
            }
        }

        if ($form == 'univ') {
            $courses = UnivCourse::where('semester', session('semester'))->get();
            foreach ($evaluations as $k => $v) {
                $course = $courses->find($v->courseId);
                $evaluations[$k]['course'] = $course->name ?? null;
                $evaluations[$k]['professor'] = $course->professor ?? null;
            }
        }

        return view('evaluations.list', compact(['evaluations', 'form']));
    }

    /**
     * Display evaluations into a table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request)
    {
        $form = $request->form;

        // Title
        switch ($form) {
            case "internship" : $title = "Internship evaluations for " . session('semester'); break;
            case "linguistic" : $title = "Ateliers Linguistiques evaluations for " . session('semester'); break;
            case "local" : $title = "VWPP Courses evaluations for " . session('semester'); break;
            case "method" : $title = "Ateliers Méthodologiques evaluations for " . session('semester'); break;
            case "program" : $title = "Program evaluations for " . session('semester'); break;
            case "tutoring" : $title = "Tutoring evaluations for " . session('semester'); break;
            case "univ" : $title = "University Courses evaluations for " . session('semester'); break;
            default : $title = "Evaluations for " . session('semester'); break;
        }

        // Courses information
        if ($form == 'local') {
            $courses = RHCourse::where('semester', session('semester'))->get();
        }

        if ($form == 'univ') {
            $courses = UnivCourse::where('semester', session('semester'))->get();
        }

        // Questions
        $questions = EvaluationHelper::get_questions($form);

        // Evaluations
        $students = Student::findMine('id');

        $evaluation = Evaluation::where('semester', session('semester'))
            ->whereIn('student', $students)
            ->where('form', $form)
            ->get();

        // Initialisation of $data
        $data = array();

        if (count($evaluation)) {
            foreach ($evaluation as $elem) {

                // Initialisation of $data
                if (!isset($data[$elem->timestamp])) {
                    for ($i = 0; $i < 60; $i++) {
                        $data[$elem->timestamp][$i] = null;
                    }
                }

                $data[$elem->timestamp][$elem->question] = $elem->response;

                if ($form == 'local') {
                    $data[$elem->timestamp][1] = $courses->find($elem->courseId)->name ?? null;
                    $data[$elem->timestamp][2] = $courses->find($elem->courseId)->professor ?? null;
                } elseif ($form == 'univ') {
                    $data[$elem->timestamp][1] = $courses->find($elem->courseId)->name ?? null;
                    $data[$elem->timestamp][2] = $courses->find($elem->courseId)->code ?? null;
                    $data[$elem->timestamp][3] = $courses->find($elem->courseId)->institution ?? null;
                    $data[$elem->timestamp][4] = $courses->find($elem->courseId)->type ?? null;
                }
            }
        }

        if ($form == 'program' and !empty($data[32])) {
            // TODO : When evaluations of Spring 2020 and before will be removed : Keep only $data[32] = json_decode($data[32]);
            $tmp = json_decode($data[32]);
            if (json_last_error() == JSON_ERROR_NONE) {
                $data[32] = $tmp;
            } else {
                $data[32] = unserialize($data[32]);
            }

            $data[32] = is_array($data[32]) ? join(' ; ', $data[32]) : null;
        }

        return view('evaluations.table', compact(['data', 'form', 'questions', 'title']));
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

    /**
     * Show who completed evaluations
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function who(Request $request)
    {
        // Students
        $students = Student::findMine();
        $students_ids = Student::findMine('id');

        // Local courses
        $local_courses = RHCourseAssignment::where('semester', session('semester'))->get();

        // University courses
        $univ_courses = UnivCourse::where('semester', session('semester'))->get();

        // Get evaluations
        $all_evaluations = Evaluation::where('semester', session('semester'))
            ->whereIn('student', $students_ids)
            ->groupBy(['form', 'timestamp'])
            ->get();

        // Count evaluations
        $evaluations = array();

        foreach ($students as $student) {
            $local_total = 0;
            $local = $local_courses->where('student', $student->id)->first();
            if (!empty($local->writing1)) { $local_total++; }
            if (!empty($local->writing2)) { $local_total++; }
            if (!empty($local->writing3)) { $local_total++; }
            if (!empty($local->seminar1)) { $local_total++; }
            if (!empty($local->seminar2)) { $local_total++; }
            if (!empty($local->seminar3)) { $local_total++; }

            $evaluations[] = (object) [
                'lastname'      => $student->lastname,
                'firstname'     => $student->firstname,
                'local_total'   => $local_total,
                'univ_total'    => $univ_courses->where('student', $student->id)->count(),
                'program'       => $all_evaluations->where('student', $student->id)->where('form', 'program')->count(),
                'local'         => $all_evaluations->where('student', $student->id)->where('form', 'local')->count(),
                'univ'          => $all_evaluations->where('student', $student->id)->where('form', 'univ')->count(),
                'tutoring'      => $all_evaluations->where('student', $student->id)->where('form', 'tutoring')->count(),
                'linguistic'    => $all_evaluations->where('student', $student->id)->where('form', 'linguistic')->count(),
                'method'        => $all_evaluations->where('student', $student->id)->where('form', 'method')->count(),
                'internship'    => $all_evaluations->where('student', $student->id)->where('form', 'internship')->count(),
            ];
        }

        return view('evaluations.who', compact(['evaluations']));
    }

}
