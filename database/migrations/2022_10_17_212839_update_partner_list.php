<?php

use App\Models\UnivCourse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePartnerList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Serie 1
        $serie1 = array(
            'Spring 2018',
            'Fall 2018',
            'Spring 2019',
            'Fall 2019',
            'Spring 2020',
            'Fall 2020',
            'Spring 2021',
            'Fall 2021',
            'Spring 2022'
        );

        $replace = array(
            'Université Paris III' => 'Paris 3',
            'Université Paris IV' => 'Paris 4',
            'Université Paris VII' => 'Paris 7',
	);

	$keys = array_keys($replace);

        $courses = UnivCourse::whereIn('semester', $serie1)->get();

        foreach ($courses as $course) {
            if (in_array($course->institution, $keys)) {
               $course->institution = $replace[$course->institution];
	       $course->save();
            }
        }

	// Serie 2
        $replace = array(
            'Université Paris III' => 'Sorbonne Nouvelle',
            'Université Paris IV' => 'Sorbonne Université',
            'Université Paris VII' => 'Paris Cité',
	);

	$keys = array_keys($replace);

        $courses = UnivCourse::whereNotIn('semester', $serie1)->get();

        foreach ($courses as $course) {
            if (in_array($course->institution, $keys)) {
               $course->institution = $replace[$course->institution];
	       $course->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Serie 1
        $serie1 = array(
            'Spring 2018',
            'Fall 2018',
            'Spring 2019',
            'Fall 2019',
            'Spring 2020',
            'Fall 2020',
            'Spring 2021',
            'Fall 2021',
            'Spring 2022'
        );

        $replace = array(
            'Paris 3' => 'Université Paris III',
            'Paris 4' => 'Université Paris IV',
            'Paris 7' => 'Université Paris VII',
	);

	$keys = array_keys($replace);

        $courses = UnivCourse::whereIn('semester', $serie1)->get();

        foreach ($courses as $course) {
            if (in_array($course->institution, $keys)) {
               $course->institution = $replace[$course->institution];
	       $course->save();
            }
        }

	// Serie 2
        $replace = array(
            'Sorbonne Nouvelle' => 'Université Paris III',
            'Sorbonne Université' => 'Université Paris IV',
            'Paris Cité' => 'Université Paris VII',
	);

	$keys = array_keys($replace);

        $courses = UnivCourse::whereNotIn('semester', $serie1)->get();

        foreach ($courses as $course) {
            if (in_array($course->institution, $keys)) {
               $course->institution = $replace[$course->institution];
	       $course->save();
            }
        }
    }
}
