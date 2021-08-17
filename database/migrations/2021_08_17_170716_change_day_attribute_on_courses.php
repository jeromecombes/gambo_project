<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RHCourse;

class ChangeDayAttributeOnCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('jour', 'day');
        });

        foreach (RHCourse::all() as $course) {
            if (!is_numeric($course->day)) {
                switch ($course->day) {
                    case 'Lundi' : $day = 0; break;
                    case 'Mardi' : $day = 1; break;
                    case 'Mercredi' : $day = 2; break;
                    case 'Jeudi' : $day = 3; break;
                    case 'Vendredi' : $day = 4; break;
                    case 'Samedi' : $day = 5; break;
                    case 'Dimanche' : $day = 6; break;
                    default : $day = null; break;
                }

                $course->day = $day;
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
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('day', 'jour');
        });
    }
}
