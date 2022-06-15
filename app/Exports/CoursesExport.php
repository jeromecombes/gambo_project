<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\RHCourse;
use App\Models\RHCourseAssignment;
use Maatwebsite\Excel\Concerns\FromArray;

class CoursesExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine();

        $courses = RHCourse::where('semester', session('semester'))->get();

        foreach ($courses as $k => $v) {
            $tab = RHCourseAssignment::where('writing1', $v->id)
                ->orWhere('writing2', $v->id)
                ->orWhere('writing3', $v->id)
                ->orWhere('seminar1', $v->id)
                ->orWhere('seminar2', $v->id)
                ->orWhere('seminar3', $v->id)
                ->orWhere('workshop1', $v->id)
                ->orWhere('workshop2', $v->id)
                ->orWhere('workshop3', $v->id)
                ->pluck('student');
            $courses[$k]['students'] = $tab;
        }

        $header[] = array('Type', 'Code', 'Title', 'French title', 'Professor', 'Student Lastname', 'Student Firstname', 'Student e-mail');

        $data = array();
        foreach ($courses as $course) {
            if (empty($course['students'])) {
                $data[] = array(
                    __($course->type),
                    $course->code,
                    $course->title,
                    $course->nom,
                    $course->professor,
                );
            } else {
                foreach ($course['students'] as $student) {
                    if (!$students->find($student)) {
                        continue;
                    }

                    $data[] = array(
                        __($course->type),
                        $course->code,
                        $course->title,
                        $course->nom,
                        $course->professor,
                        $students->find($student)->lastname,
                        $students->find($student)->firstname,
                        $students->find($student)->email,
                    );
                }
            }
        }

        usort($data, function($a, $b) { return $a[1].$a[4].$a[5] > $b[1].$b[4].$b[5]; });

        return array_merge($header, $data);
    }
}
