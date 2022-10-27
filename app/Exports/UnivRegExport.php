<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Partner;
use App\Models\UnivReg;
use App\Models\UnivReg3;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;

class UnivRegExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine()
            ->whereIn('id', request()->students);

        $partners = Partner::getCurrents()->where('univreg', 1);

        $univ_reg = UnivReg::where('semester', session('semester'))->get();
        $univ_reg3 = UnivReg3::where('semester', session('semester'))->get();

        $header1[] = array(
            'Lastname',
            'Firstname',
            'Major 1',
            'Minor 1',
            'Major 2',
            'Minor 2',
        );

        foreach ($partners as $partner) {
            $header1[] = $partner->name;
        }

        $header2 = array(
            'Justification',
            'Motivated by the calendar',
            'Final Reg.',
            'Diploma',
            'Graduation Year',
            'Country',
            'City',
            'State',
            'Start college',
            'Disability or special needs',
            'Details',
        );

        $header = array_merge($header1, $header2);

        $data = array();

        foreach ($students as $student) {

            $data[] = array(
                $student->lastname,
                $student->firstname,
                $univ_reg->where('student', $student->id)->where('question', '10')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '12')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '11')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '13')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '14')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '15')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '16')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '17')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '18')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '19')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '22')->first()->response ?? null,
                $univ_reg3->where('student', $student->id)->first()->university ?? null,
                $univ_reg->where('student', $student->id)->where('question', '1')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '2')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '3')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '4')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '5')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '6')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '7')->first()->response ?? null,
                $univ_reg->where('student', $student->id)->where('question', '8')->first()->response ?? null,
            );
        }

        usort($data, function($a, $b) { return $a[0].$a[1] > $b[0].$b[1]; });

        return array_merge($header, $data);
    }
}
