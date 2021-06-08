<?php

namespace App\Http\Controllers;

use App\Helpers\CourseHelper;
use App\Models\Grade;
use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use App\Models\Student;
use App\Models\UnivCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Exports\GradesExport;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends Controller
{

    private $grades = array('', 'A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F', 'Pass', 'S', 'DS', 'W');

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('semester');
        $this->middleware('role:18|19|20');
        $this->middleware('student.list')->only('edit');
        $this->middleware('role:18|19')->only(['update', 'list_update']);

        App::setLocale('fr_FR');
    }

    /**
     * Edit
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = auth()->user();

        $edit = $request->edit;

        // Admin Read only
        $us_ro = (in_array(19, $user->access) or in_array(20, $user->access));
        // Admin update FR grades
        $fr_rw = in_array(18, $user->access);
        // Admin update US grades
        $us_rw = in_array(19, $user->access);

        // Get student courses
        $courses = CourseHelper::get();

        $default_grades = (object) array(
            'note' => null,
            'date1' => null,
            'date2' => null,
            'grade' => null,
            'grade1' => null,
            'grade2' => null,
        );

        // Grades
        $grades_tab = $this->grades;

        $all_grades = Grade::getMe();

        $grades = array();

        foreach ($courses->local as $elem) {
            $grades['local'][$elem->id] = $all_grades->where('course', 'local')->where('course_id', $elem->id)->first() ?? $default_grades;
        }

        foreach ($courses->univ as $elem) {
            $grades['univ'][$elem->id] = $all_grades->where('course', 'univ')->where('course_id', $elem->id)->first() ?? $default_grades;
        }

        $params = compact(
            'edit',
            'fr_rw',
            'us_ro',
            'us_rw',
            'grades',
            'grades_tab',
            'courses',
        );

        // View
        return view('grades.edit', $params);
    }

    /**
     * Export grades
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $filename = 'grades_' .session('semester') . '.xlsx';

        return Excel::download(new GradesExport, $filename);
    }

    /**
     * Add or update
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Get student courses
        $courses = CourseHelper::get();

        foreach ($courses as $key => $value) {
            foreach ($value as $course) {
                $grade = Grade::firstOrCreate(array(
                        'semester' => session('semester'),
                        'student' => session('student'),
                        'course' => $key,
                        'course_id' => $course->id,
                    ));

                if (in_array(18, $user->access)) {
                    $grade->note = $request->{$key.'_fr_'.$course->id};
                    $grade->date1 = $request->{$key.'_fr_date_'.$course->id};
                }
                if (in_array(19, $user->access)) {
                    $grade->date2 = $request->{$key.'_us_date_'.$course->id};
                    $grade->grade = $request->{$key.'_us_'.$course->id};
                    $grade->grade1 = $request->{$key.'_us1_'.$course->id};
                    $grade->grade2 = $request->{$key.'_us2_'.$course->id};
                }
                $grade->save();
            }
        }

        return redirect()->route('grades.edit')->with('success', 'Mise à jour réussie');
    }

    /**
     * Admin home
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {

        $students = Student::findMine();
        $student_list = $students->pluck('id');

        $local = RHCourse::where('semester', session('semester'))->get();

        $univ = UnivCourse::where('semester', session('semester'))
            ->where('note', 1)
            ->whereIn('student', $student_list)
            ->get();

        // View
        return view('grades.home', compact(['local', 'students', 'univ']));
    }

    /**
     * Admin list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $edit = $request->edit ?? null;
        $id = $request->id;
        $univ = $request->univ;

        $myStudents = Student::findMine();

        if ($univ == 'local') {
            $course = RHCourse::find($id);
            $assignment = RHCourseAssignment::where('writing1', $id)
                ->orWhere('writing2', $id)
                ->orWhere('writing3', $id)
                ->orWhere('seminar1', $id)
                ->orWhere('seminar2', $id)
                ->orWhere('seminar3', $id)
                ->pluck('student');

            $students = $myStudents->whereIn('id', $assignment);

        } else {
            $course = UnivCourse::find($id);
            $students = $myStudents->whereIn('id', $course->student);
        }

        $all_grades = Grade::where('semester', session('semester'))
            ->where('course', $univ)
            ->where('course_id', $id)
            ->get();

        foreach ($students as $k => $v) {
            $students[$k]['note'] = $all_grades->where('student', $v->id)->first()->note ?? null;
            $students[$k]['date1'] = $all_grades->where('student', $v->id)->first()->date1 ?? null;
            $students[$k]['grade1'] = $all_grades->where('student', $v->id)->first()->grade1 ?? null;
            $students[$k]['grade2'] = $all_grades->where('student', $v->id)->first()->grade2 ?? null;
            $students[$k]['grade'] = $all_grades->where('student', $v->id)->first()->grade ?? null;
            $students[$k]['date2'] = $all_grades->where('student', $v->id)->first()->date2 ?? null;
        }

        // Grades
        $grades = array_combine($this->grades, $this->grades);

        // View
        return view('grades.list', compact(['course', 'edit', 'grades', 'id', 'students', 'univ']));
    }

    /**
     * Admin list update
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list_update(Request $request)
    {
        $id = $request->id;
        $univ = $request->univ;

        $input = $request->all();

        foreach ($input as $key => $value) {
          $tmp = explode("_",$key);

          if (!in_array($tmp[0], ['date1', 'date2', 'grade', 'grade1', 'grade2', 'note'])) {
            continue;
          }

          $grades = Grade::firstOrCreate([
            'semester' => session('semester'),
            'student' => $tmp[1],
            'course' => $univ,
            'course_id' => $id,
          ]);

          $grades->{$tmp[0]} = $value;
          $grades->save();
        }

        return redirect()->route('grades.home')->with('success', 'Mise à jour réussie');
    }
}
