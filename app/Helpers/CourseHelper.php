<?php

namespace App\Helpers;

use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use App\Models\UnivCourse;

class CourseHelper
{

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
