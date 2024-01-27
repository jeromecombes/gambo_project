<?php

namespace App\Helpers;

use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use App\Models\UnivCourse;

class CourseHelper
{

    public static function all()
    {
        // Local courses = VWPP Courses
        $courses['local'] = RHCourse::where('semester', session('semester'))->orderBy('type')->get();

        // Univ courses
        $courses['univ'] = UnivCourse::where('semester', session('semester'))->orderBy('institution')->get();

        $assignments = RHCourseAssignment::where('semester', session('semester'))->get();

        foreach ($courses['local'] as $k => $v) {
            $students = array();
            $students = array_merge($students, $assignments->where('writing1', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('writing2', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('writing3', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('seminar1', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('seminar2', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('seminar3', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('workshop1', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('workshop2', $v->id)->pluck('student')->toArray());
            $students = array_merge($students, $assignments->where('workshop3', $v->id)->pluck('student')->toArray());
            $courses['local'][$k]['students'] = $students;
        }

        // All Courses
        $courses['all'] = array();

        foreach ($courses['local'] as $elem) {
            $courses['all'][] = $elem;
        }

        foreach ($courses['univ'] as $elem) {
            $courses['all'][] = $elem;
        }

        return (object) $courses;
    }

    public static function get()
    {
        // Local courses = VWPP Courses
        $assignment = array();
        $a = RHCourseAssignment::findOrCreateMe();
        if ($a->writing1) { $assignment[] = $a->writing1; }
        if ($a->writing2) { $assignment[] = $a->writing2; }
        if ($a->seminar1) { $assignment[] = $a->seminar1; }
        if ($a->seminar2) { $assignment[] = $a->seminar2; }
        if ($a->seminar3) { $assignment[] = $a->seminar3; }
        if ($a->workshop1) { $assignment[] = $a->workshop1; }
        if ($a->workshop2) { $assignment[] = $a->workshop2; }
        if ($a->workshop3) { $assignment[] = $a->workshop3; }

        $courses['local'] = RHCourse::whereIn('id', $assignment)->orderBy('type')->get();

        // Univ courses
        $courses['univ'] = UnivCourse::getMe();

        // All Courses
        $courses['all'] = array();

        foreach ($courses['local'] as $elem) {
            $courses['all'][] = $elem;
        }

        foreach ($courses['univ'] as $elem) {
            $courses['all'][] = $elem;
        }

        return (object) $courses;
    }
}
