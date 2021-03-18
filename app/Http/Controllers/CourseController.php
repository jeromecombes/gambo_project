<?php

namespace App\Http\Controllers;

use App\Models\CourseChoice;
use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use App\Models\RHCourseLock;
use App\Models\RHCoursePublish;
use App\Models\Student;
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
    public function student_form(Request $request)
    {

        $edit = $request->edit;

        // Get student info
        $student = Student::find(session('student'));

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
        $assignment = $rhCoursesAssign->where('student', session('student'))->first();

        // Student assignment Text
        $aw1 = $rhCourses->find($assignment->writing1);
        $aw2 = $rhCourses->find($assignment->writing2);
        $as1 = $rhCourses->find($assignment->seminar1);
        $as2 = $rhCourses->find($assignment->seminar2);
        $as3 = $rhCourses->find($assignment->seminar3);

        $assignment_text = (object) array(
            'writing1' => $aw1 ? $aw1->code . ' ' . $aw1->title . ', ' . $aw1->professor : null,
            'writing2' => $aw2 ? $aw2->code . ' ' . $aw2->title . ', ' . $aw2->professor : null,
            'seminar1' => $as1 ? $as1->code . ' ' . $as1->title . ', ' . $as1->professor : null,
            'seminar2' => $as2 ? $as2->code . ' ' . $as2->title . ', ' . $as2->professor : null,
            'seminar3' => $as3 ? $as3->code . ' ' . $as3->title . ', ' . $as3->professor : null,
        );

        // Student Choices
        $choices = CourseChoice::findMe();

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

        return redirect("/admin/courses")->with('success', 'Mise à jour réussie');
    }

}
