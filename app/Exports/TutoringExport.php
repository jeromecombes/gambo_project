<?php

namespace App\Exports;

use App\Models\Tutoring;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;

class TutoringExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine()->whereIn('id', request()->students);

        $student_ids = $students->pluck('id')->toArray();

        $tutorings = Tutoring::where('semester', session('semester'))
            ->whereIn('student', $student_ids)
            ->get();

        $header[] = array(
            'Lastname',
            'Firstname',
            'Tutor',
            'Day',
            'From',
            'To',
            );

        $data = array();

        foreach ($tutorings as $tutoring) {
            $data[] = array(
                $students->find($tutoring->student)->lastname,
                $students->find($tutoring->student)->firstname,
                $tutoring->professor,
                $tutoring->dayText,
                $tutoring->start,
                $tutoring->end,
            );
        }

        usort($data, function($a, $b) { return $a[0].$a[1].$a[2].$a[3].$a[4].$a[5] > $b[0].$b[1].$b[2].$b[3].$b[4].$b[5]; });

        return array_merge($header, $data);
    }
}
