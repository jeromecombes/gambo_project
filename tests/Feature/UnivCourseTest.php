<?php

namespace Tests\Feature;

use App\Models\UnivCourse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnivCourseTest extends MyTestCase
{
    public function test_univ_course_list()
    {
        $courses = UnivCourse::whereIn('semester', array('Spring 2018', 'Fall 2018', 'Spring 2019', 'Fall 2019', 'Spring 2020', 'Fall 2020', 'Spring 2021', 'Fall 2021', 'Spring 2022'))->get();

	foreach ($courses as $course) {
	    $test = in_array($course->institution, array('Paris 3', 'Paris 4', 'Paris 7', 'Autre', ''));
	    $this->assertTrue($test);

	    $test = !in_array($course->institution, array('Université Paris III', 'Université Paris IV', 'Université Paris VII'));
	    $this->assertTrue($test);

	    $test = !in_array($course->institution, array('Sorbonne Nouvelle', 'Sorbonne Université', 'Paris Cité', 'UPEC'));
	    $this->assertTrue($test);
	}

        $courses = UnivCourse::whereIn('semester', array('Fall 2022', 'Spring 2023', 'Fall 2023'))->get();

	foreach ($courses as $course) {
	    $test = !in_array($course->institution, array('Université Paris III', 'Université Paris IV', 'Université Paris VII'));
	    $this->assertTrue($test);

	    $test = !in_array($course->institution, array('Paris 3', 'Paris 4', 'Paris 7'));
	    $this->assertTrue($test);
	}
    }

}
