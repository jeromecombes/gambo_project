<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UnivCourse;

class RemoveHtmlEntitiesFromCoursesUniv4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (UnivCourse::all() as $course) {
            $course->discipline = str_replace('&#039;', "'", html_entity_decode($course->discipline));
            $course->institution = str_replace('&#039;', "'", html_entity_decode($course->institution));
            $course->institutionAutre = str_replace('&#039;', "'", html_entity_decode($course->institutionAutre));
            $course->modalites1 = str_replace('&#039;', "'", html_entity_decode($course->modalites1));
            $course->modalites2 = str_replace('&#039;', "'", html_entity_decode($course->modalites2));
            $course->nom = str_replace('&#039;', "'", html_entity_decode($course->nom));
            $course->prof = str_replace('&#039;', "'", html_entity_decode($course->prof));
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
