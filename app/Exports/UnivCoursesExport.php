<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\UnivCourse;
use Maatwebsite\Excel\Concerns\FromArray;

class UnivCoursesExport implements FromArray
{

    public function array(): array
    {
        // Fields to display
        $fields = array(
            ['institution', 'Institution'],
            ['discipline', 'Discipline'],
            ['niveau', 'Niveau'],
            ['code', 'Code'],
            ['nom', 'Nom'],
            ['type', 'Type'],
            ['prof', 'Professeur'],
            ['email', 'E-mail'],
            ['day', 'Jour'],
            ['start', 'Début'],
            ['end', 'Fin'],
            ['modalites', 'Modalités'],
            ['modalites1', 'Modalités 1'],
            ['modalites2', 'Modalités 2'],
            ['student_lastname', 'Student Lastname'],
            ['student_firstname', 'Student Firstname'],
        );

        // Get students and courses
        $students = Student::findMine();

        $courses = UnivCourse::where('semester', session('semester'))
            ->whereIn('student', $students->pluck('id'))
            ->get();

        // Main courses (all courses which are not linked to another one)
        // and Extra courses (courses which are linked to another one)
        $main = array();
        $extra = array();
        foreach ($courses as $course) {
            if (!$course->linkedTo) {
                $main[$course->id] = $course;
                $main[$course->id]['student'] = $students->find($course->student);
            } else {
                $id = $course->linkedTo->id;
                $extra[$id][$course->id] = $course;
                $extra[$id][$course->id]['student'] = $students->find($course->student);
            }
        }

        // Sort main courses
        uasort($main, function($a, $b) { return $a->institution > $b->institution; });

        // Link extra courses to main courses
        $data = array();
        foreach ($main as $elem) {
            $data[] = $elem;
            if (array_key_exists($elem->id, $extra)) {
                foreach ($extra[$elem->id] as $ext) {
                    $data[] = $ext;
                }
            }
        }

        $all = array();
        $line = array();
        foreach ($fields as $field) {
            $line[] = $field[1];
        }

        $all[] = $line;

        foreach ($data as $elem) {
            $line = array();
            foreach ($fields as $field) {
                if (substr($field[0], 0, 8) == 'student_') {
                    $key = substr($field[0], 8);
                    $line[] = $elem->student->{$key};
                } elseif ($field[0] == 'day') {
                    $line[] = __($elem->dayText);
                } else {
                    $line[] = $elem->{$field[0]};
                }
            }
            $all[] = $line;
        }

        return $all;
    }

}
