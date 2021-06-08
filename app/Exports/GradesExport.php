<?php

namespace App\Exports;

use App\Models\Grade;
use App\Models\Student;
use App\Helpers\CourseHelper;
use Maatwebsite\Excel\Concerns\FromArray;

class GradesExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine();
        $student_ids = $students->pluck('id')->toArray();

        $courses = CourseHelper::all();

        $grades = Grade::where('semester', session('semester'))->get();

        $header[] = array(
            'University',
            'Code',
            'Type / Level',
            'Title / Discipline',
            'French title',
            'Professor',
            'Student Lastname',
            'Student Firstname',
            'Student University',
            'French grade',
            'Date received',
            'Pass/Fail NRO',
            'Actual Grade',
            'Reported Grade',
            'Date recorded',
            );

        $data = array();

        foreach ($courses->local as $course) {
            foreach ($course->students as $student) {
                if (!in_array($student , $student_ids)) {
                    continue;
                }

                $grade = $grades->where('course', 'local')
                    ->where('course_id', $course->id)
                    ->where('student', $student)
                    ->first();

                $data[] = array(
                    'VWPP',
                    $course->code,
                    $course->type,
                    $course->title,
                    $course->nom,
                    $course->professor,
                    $students->find($student)->lastname,
                    $students->find($student)->firstname,
                    $students->find($student)->university,
                    $grade->note,
                    $grade->date1,
                    $grade->grade1,
                    $grade->grade2,
                    $grade->grade,
                    $grade->date2,
                );
            }
        }

        foreach ($courses->univ as $course) {
            $student = $course->student;

            if (!in_array($student , $student_ids)) {
                continue;
            }

            $grade = $grades->where('course', 'univ')
                ->where('course_id', $course->id)
                ->where('student', $student)
                ->first();

            $data[] = array(
                $course->institution,
                $course->code,
                $course->type,
                $course->discipline,
                $course->nom,
                $course->professor,
                $students->find($student)->lastname,
                $students->find($student)->firstname,
                $students->find($student)->university,
                $grade->note,
                $grade->date1,
                $grade->grade1,
                $grade->grade2,
                $grade->grade,
                $grade->date2,
            );
        }

        usort($data, function($a, $b) { return $a[0].$a[1].$a[3].$a[7].$a[8] > $b[0].$b[1].$b[3].$b[7].$b[8]; });

        return array_merge($header, $data);
    }
}
