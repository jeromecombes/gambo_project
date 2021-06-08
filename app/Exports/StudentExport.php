<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Host;
use App\Models\HousingAssignment;
use App\Models\UnivReg3;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;

class StudentExport implements FromArray
{

    public function array(): array
    {

        $students = Student::findMine()->whereIn('id', request()->students);
        $student_ids = $students->pluck('id')->toArray();

        $hosts = Host::getHosts(session('semester'));
        $housing = HousingAssignment::where('semester', session('semester'))->get();

        $univ_reg = UnivReg3::where('semester', session('semester'))->get();

        $header[] = array(
            'Lastname',
            'Firstname',
            'Gender',
            'Home Institution',
            'Semesters',
            'French Univ.',
            'French Univ. Number',
            'Citizenship1',
            'Citizenship2',
            'DOB',
            'Place OB',
            'Country OB',
            'Email',
            'Cellphone',
            'Contact Lastname',
            'Contact Firstname',
            'C Street',
            'C City',
            'C Zip',
            'C State',
            'C Country',
            'C Email',
            'C Phone',
            'C Mobile',
            'Address FR',
            'Zip code FR',
            'City FR',
            'Phone numer FR',
            'H Lastname',
            'H Firstname',
            'H cellphone',
            'H email',
            'H Lastname 2',
            'H Firstname 2',
            'H Cellphone 2',
            'H Email 2',
            );

        $data = array();

        foreach ($students as $student) {

            $h = $housing->where('student', $student->id)->first();
            $host = $h ? $hosts->find($h->host) : null;

            $french_univ = $univ_reg->where('student', $student->id)->first()->university ?? null;

            $data[] = array(
                $student->firstname,
                $student->lastname,
                $student->gender,
                $student->university,
                implode(', ', $student->semesters),
                $french_univ,
                $student->frenchNumber,
                $student->citizenship1,
                $student->citizenship2,
                $student->dob,
                $student->placeOB,
                $student->countryOB,
                $student->email,
                $student->cellphone,
                $student->contactlast,
                $student->contactfirst,
                $student->street,
                $student->city,
                $student->zip,
                $student->state,
                $student->country,
                $student->contactemail,
                $student->contactphone,
                $student->contactmobile,
                $host->address ?? null,
                $host->zipcode ?? null,
                $host->city ?? null,
                $host->phonenumber ?? null,
                $host->lastname ?? null,
                $host->firstname ?? null,
                $host->cellphone ?? null,
                $host->email ?? null,
                $host->lastname2 ?? null,
                $host->firstname2 ?? null,
                $host->cellphone2 ?? null,
                $host->email2 ?? null,
            );
        }

        usort($data, function($a, $b) { return $a[0].$a[1] > $b[0].$b[1]; });

        return array_merge($header, $data);
    }
}
