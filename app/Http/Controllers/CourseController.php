<?php

namespace App\Http\Controllers;

use App\Models\CourseChoice;
use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use App\Models\RHCourseLock;
use App\Models\RHCoursePublish;
use App\Models\Student;
use App\Models\UnivCourse;
use Illuminate\Http\Request;

include_once( __DIR__ . '/../../Includes/functions.php');

class CourseController extends Controller
{
    /**
     * Display the courses student form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (session('admin')) {
            return $this->admin_index($request);
        } else {
            echo "// TODO";
        }
    }

    /**
     * Display the courses student form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_index(Request $request)
    {
        $edit = $request->edit;

        // Get student info
        $student = Student::find(session('student'));

        // VWPP Courses

        // Lock / Unlock - Publish / Hide buttons
        $button_lock = RHCourseLock::findMe() ? 'Unlock' : 'Lock';
        $button_publish = RHCoursePublish::findMe() ? 'Hide' : 'Publish';

        // Reid Hall Courses
        $rhCourses = RHCourse::where('semester', session('semester'))->orderBy('type')->get();

        // Reid Hall Courses Assignment
        $rhCoursesAssign = RHCourseAssignment::where('semester', session('semester'))->get();

        // Count all
        $tab = array();
        foreach ($rhCoursesAssign as $elem) {
            if (!empty($elem->writing1)) $tab[] = $elem->writing1;
            if (!empty($elem->writing2)) $tab[] = $elem->writing2;
            if (!empty($elem->writing3)) $tab[] = $elem->writing3;
            if (!empty($elem->seminar1)) $tab[] = $elem->seminar1;
            if (!empty($elem->seminar2)) $tab[] = $elem->seminar2;
            if (!empty($elem->seminar3)) $tab[] = $elem->seminar3;
        }

        $count = array_count_values($tab);

        $occurences = array();
        foreach ($rhCourses as $elem) {
            $occurences[$elem->type][] = array(
                'count' => (int) $count[$elem->id],
                'code' => $elem->code,
                'title' => $elem->title,
                'professor' => $elem->professor,
                'type' => $elem->type
            );
        }

        usort($occurences['Seminar'], 'cmp_count_desc');
        usort($occurences['Writing'], 'cmp_count_desc');

        // Student assignment IDs
        $assignment = $rhCoursesAssign->where('student', session('student'))->first() ?? (object) array(
            'writing1' => null,
            'writing2' => null,
            'seminar1' => null,
            'seminar2' => null,
            'seminar3' => null,
            );

        // Student assignment Text
        $aw1 = $assignment ? $rhCourses->find($assignment->writing1) :null;
        $aw2 = $assignment ? $rhCourses->find($assignment->writing2) :null;
        $as1 = $assignment ? $rhCourses->find($assignment->seminar1) :null;
        $as2 = $assignment ? $rhCourses->find($assignment->seminar2) :null;
        $as3 = $assignment ? $rhCourses->find($assignment->seminar3) :null;

        $assignment_text = (object) array(
            'writing1' => $aw1 ? $aw1->code . ' ' . $aw1->title . ', ' . $aw1->professor : null,
            'writing2' => $aw2 ? $aw2->code . ' ' . $aw2->title . ', ' . $aw2->professor : null,
            'seminar1' => $as1 ? $as1->code . ' ' . $as1->title . ', ' . $as1->professor : null,
            'seminar2' => $as2 ? $as2->code . ' ' . $as2->title . ', ' . $as2->professor : null,
            'seminar3' => $as3 ? $as3->code . ' ' . $as3->title . ', ' . $as3->professor : null,
        );

        // Student Choices
        $choices = CourseChoice::findMe() ?? (object) array(
            'a1' => null,
            'b1' => null,
            'c1' => null,
            'd1' => null,
            'a2' => null,
            'b2' => null,
            'c2' => null,
            'd2' => null,
            'e2' => null,
            );


        // University Courses

        // Students courses
        $courses = UnivCourse::getMe();


        // TEST
        $admin = true;
        $admin2 = true;
        $hoursStart = 8;
        $hoursEnd = 21;

        // TODO : use $courses on template to make the link
        $coursesForLink = array();
        foreach ($courses as $elem) {
            if (!$elem['lien']) {
                $coursesForLink[] = $elem;
            }
        }
        // TODO See How to manage, probably in the template  this : unset($coursesForLink[$course['id']]);

        $days = array(
            '' => array(null, null),
            0 => array(null, null),
            1 => array(1, 'Lundi'),
            2 => array(2, 'Mardi'),
            3 => array(3, 'Mercredi'),
            4 => array(4, 'Jeudi'),
            5 => array(5, 'Vendredi'),
            6 => array(6, 'Samedi'),
            7 => array(7, 'Dimanche')
        );

        $params = compact(
            'edit',
            'student',
            'assignment',
            'assignment_text',
            'button_lock',
            'button_publish',
            'choices',
            'occurences',
            'rhCourses',
            'courses',
            'admin',
            'admin2',
            'coursesForLink',
            'days',
            'hoursStart',
            'hoursEnd',
        );


        // View
        return view('courses.admin', $params);
    }

    /**
     * Reid Hall Courses Assignment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reidhall_assignment(Request $request)
    {

        $student = $request->student;

        RHCourseAssignment::updateOrCreate(array(
                'student' => session('student'),
                'semester' => session('semester'),
            ),
            array(
                'writing1' => $request->writing1,
                'writing2' => $request->writing2,
                'writing3' => $request->writing3,
                'seminar1' => $request->seminar1,
                'seminar2' => $request->seminar2,
                'seminar3' => $request->seminar3,
            )
        );

        return redirect("/courses")->with('success', 'Mise à jour réussie');
    }

    /**
     * Edit a university course
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function univ_edit(Request $request)
    {

        $id = $request->id;
        $edit = $request->edit;

        // All existing students courses for making links
        $courses = UnivCourse::getMe();

        // Add a new course
        if ($request->add) {
            $edit = 'edit';
            $course = new UnivCourse();

        // Edit an existing course
        } else {
            // The selected course
            $course = $courses->find($id);
        }


        $admin = true;
        $admin2 = true;
        $hoursStart = 8;
        $hoursEnd = 21;

        $coursesForLink = array();
        foreach ($courses as $elem) {
            if (!$elem['lien']) {
                $coursesForLink[] = $elem;
            }
        }
        // TODO See How to manage, probably in the template  this : unset($coursesForLink[$course['id']]);

        $days = array(
            1 => array(1, 'Lundi'),
            2 => array(2, 'Mardi'),
            3 => array(3, 'Mercredi'),
            4 => array(4, 'Jeudi'),
            5 => array(5, 'Vendredi'),
            6 => array(6, 'Samedi'),
            7 => array(7, 'Dimanche')
        );

        $params = compact(
            'edit',
            'courses',
            'course',
            'admin',
            'admin2',
            'coursesForLink',
            'days',
            'hoursStart',
            'hoursEnd',
        );


        // View
        return view('courses.university_form', $params);
    }

}
