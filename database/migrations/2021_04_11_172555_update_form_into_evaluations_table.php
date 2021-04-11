<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFormIntoEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('evaluations')
              ->where('form', 'linguistique')
              ->update(['form' => 'linguistic']);

        DB::table('evaluations')
              ->where('form', 'ReidHall')
              ->update(['form' => 'local']);

        DB::table('evaluations')
              ->where('form', 'tutorats')
              ->update(['form' => 'tutoring']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('evaluations')
              ->where('form', 'linguistic')
              ->update(['form' => 'linguistique']);

        DB::table('evaluations')
              ->where('form', 'local')
              ->update(['form' => 'ReidHall']);

        DB::table('evaluations')
              ->where('form', 'tutoring')
              ->update(['form' => 'tutorats']);
    }
}
