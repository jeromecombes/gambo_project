<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RHCourse;

class RemoveHtmlEntitiesFromCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (RHCourse::all() as $course) {
            $course->professor = str_replace('&#039;', "'", html_entity_decode($course->professor));
            $course->name = str_replace('&#039;', "'", html_entity_decode($course->name));
            $course->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
