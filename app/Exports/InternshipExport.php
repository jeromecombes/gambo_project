<?php

namespace App\Exports;

use App\Models\Internship;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;

class InternshipExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine()->whereIn('id', request()->students);

        $student_ids = $students->pluck('id')->toArray();

        $internships = Internship::where('semester', session('semester'))
            ->whereIn('student', $student_ids)
            ->get();

        $header[] = array(
            'Lastname',
            'Firstname',
            'Internship',
            'Comment',
            );

        $data = array();

        foreach ($internships as $internship) {
            $data[] = array(
                $students->find($internship->student)->lastname,
                $students->find($internship->student)->firstname,
                $internship->name,
                $internship->notes,
            );
        }

        usort($data, function($a, $b) { return $a[0].$a[1].$a[2] > $b[0].$b[1].$b[2]; });

        return array_merge($header, $data);
    }
}
