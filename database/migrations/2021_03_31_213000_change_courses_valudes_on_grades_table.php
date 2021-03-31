<?php

use App\Models\Grade;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCoursesValudesOnGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (Grade::where('course','VWPP')->get() as $grade) {
            $grade->course = 'local';
            $grade->save();
        }

        foreach (Grade::where('course','UNIV')->get() as $grade) {
            $grade->course = 'univ';
            $grade->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (Grade::where('course','local')->get() as $grade) {
            $grade->course = 'VWPP';
            $grade->save();
        }

        foreach (Grade::where('course','univ')->get() as $grade) {
            $grade->course = 'UNIV';
            $grade->save();
        }
    }
}
