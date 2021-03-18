<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RHCourseChoiceRenameSemesters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $results = DB::table('courses_choices')->select('id','semester')->get();

        foreach ($results as $result) {
            DB::table('courses_choices')
                ->where('id',$result->id)
                ->update(['semester' => str_replace('_', ' ', $result->semester)]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $results = DB::table('courses_choices')->select('id','semester')->get();

        foreach ($results as $result) {
            DB::table('courses_choices')
                ->where('id',$result->id)
                ->update(['semester' => str_replace(' ', '_', $result->semester)]);
        }
    }
}
