<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\CourseChoice;
use App\Models\RHCourse;
use Maatwebsite\Excel\Concerns\FromArray;

class ChoicesExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine();

        $courses = RHCourse::where('semester', session('semester'))->get();

        foreach ($courses as $k => $v) {
            $choices = CourseChoice::where('a1', $v->id)
                ->orWhere('a2', $v->id)
                ->orWhere('b1', $v->id)
                ->orWhere('b2', $v->id)
                ->orWhere('c1', $v->id)
                ->orWhere('c2', $v->id)
                ->orWhere('d1', $v->id)
                ->orWhere('d2', $v->id)
                ->orWhere('e2', $v->id)
                ->get();
            $courses[$k]['choices'] = $choices;
        }

        $header[] = array('Type', 'Code', 'Title', 'French title', 'Professor', 'Student Lastname', 'Student Firstname', 'Student e-mail', 'Choice');

        $data = array();
        foreach ($courses as $course) {
            if (empty($course['choices'])) {
                $data[] = array(
                    $course->type,
                    $course->code,
                    $course->title,
                    $course->nom,
                    $course->professor,
                );
            } else {
                foreach ($course['choices'] as $choice) {
                    if (!$students->find($choice->student)) {
                        continue;
                    }

                    $student_choice = null;

                    if ($choice->a1 == $course->id or $choice->a2 == $course->id) {
                        $student_choice = '1st';
                    }elseif ($choice->b1 == $course->id or $choice->b2 == $course->id) {
                        $student_choice = '2nd';
                    }elseif ($choice->c1 == $course->id or $choice->c2 == $course->id) {
                        $student_choice = '3rd';
                    }elseif ($choice->d1 == $course->id or $choice->d2 == $course->id) {
                        $student_choice = '4th';
                    }elseif ($choice->e2 == $course->id) {
                        $student_choice = '5th';
                    }

                    $data[] = array(
                        $course->type,
                        $course->code,
                        $course->title,
                        $course->nom,
                        $course->professor,
                        $students->find($choice->student)->lastname,
                        $students->find($choice->student)->firstname,
                        $students->find($choice->student)->email,
                        $student_choice,
                    );
                }
            }
        }

        usort($data, function($a, $b) { return $a[1].$a[8].$a[4].$a[5] > $b[1].$b[8].$b[4].$b[5]; });

        return array_merge($header, $data);
    }
}
