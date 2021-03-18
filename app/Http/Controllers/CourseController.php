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
        $semester = str_replace(' ', '_', session('semester'));
        $rhCourses = RHCourse::where('semester', $semester)->orderBy('type')->get();

        // Reid Hall Courses Assignment
        $rhCoursesAssign = RHCourseAssignment::where('semester', $semester)->get();

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

        usort($occurences['Seminar'], 'cmp_countDesc');
        usort($occurences['Writing'], 'cmp_countDesc');

        // Student assignment
        $assignment = $rhCoursesAssign->where('student', session('student'))->first();

        // Student Choices
        $choices = CourseChoice::findMe();

        $params = compact(
            'edit',
            'student',
            'assignment',
            'button_lock',
            'button_publish',
            'choices',
            'occurences',
            'rhCourses',
        );

        // View
        return view('courses.admin_courses', $params);
    }

    /**
     * Update courses student information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student_form_update(Request $request)
    {

        $student = $request->student;
        $semester = str_replace(' ', '_', session('semester'));

        return redirect("/courses")->with('success', 'Mise à jour réussie');
    }

}
