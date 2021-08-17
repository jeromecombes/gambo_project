<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UnivCourse;

class ChangeDayAttributeOnUnivcourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_univ4', function (Blueprint $table) {
            $table->renameColumn('jour', 'day');
        });

        foreach (UnivCourse::all() as $course) {
            if (is_numeric($course->day)) {
                $course->day = $course->day - 1;
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
        Schema::table('courses_univ4', function (Blueprint $table) {
            $table->renameColumn('day', 'jour');
        });
    }
}
