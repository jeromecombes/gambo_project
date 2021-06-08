<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Host;
use App\Models\HousingAssignment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;

class hostExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine();
        $student_ids = $students->pluck('id')->toArray();

        $hosts = Host::getHosts(session('semester'))
            ->whereIn('id', request()->hosts);

        $housing = HousingAssignment::where('semester', session('semester'))->get();

        $header[] = array(
            'Lastname',
            'Firstname',
            'Address',
            'Zip Code',
            'City',
            'Phone Number',
            'Cellphone',
            'Email',
            'Lastname 2',
            'Firstname 2',
            'Cellphone 2',
            'Email 2',
            'Student Lastname',
            'Student Firstname',
            );

        $data = array();

        foreach ($hosts as $host) {

            $h = $housing->where('logement', $host->id)->first();
            $student = $h ? $students->find($h->student) : null;

            $data[] = array(
                $host->lastname,
                $host->firstname,
                $host->address,
                $host->zipcode,
                $host->city,
                $host->phonenumber,
                $host->cellphone,
                $host->email,
                $host->lastname2,
                $host->firstname2,
                $host->cellphone2,
                $host->email2,
                ($student and in_array($student->id, $student_ids)) ? $student->lastname : null,
                ($student and in_array($student->id, $student_ids)) ? $student->firstname : null,
            );
        }

        usort($data, function($a, $b) { return $a[0].$a[1] > $b[0].$b[1]; });

        return array_merge($header, $data);
    }
}
