<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StandardizeSemesterField extends Migration
{

    private $tables_with_semestre = ['forms', 'housing', 'students', 'univ_reg'];
    private $tables_with_underscore =  ['courses', 'courses_attrib_rh', 'eval_enabled', 'evaluations', 'forms', 'housing', 'students', 'univ_reg'];
    private $tables_with_semester_not_null =  ['courses', 'courses_univ', 'evaluations', 'forms'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach ($this->tables_with_semestre as $elem) {
            Schema::table($elem, function (Blueprint $table) {
                $table->renameColumn('semestre', 'semester');
            });
        }

        foreach ($this->tables_with_semester_not_null as $elem) {
            Schema::table($elem, function (Blueprint $table) {
                $table->string('semester', 20)->nullable()->change();
            });
        }

        foreach ($this->tables_with_underscore as $elem) {
            $results = DB::table($elem)->select('id','semester')->get();

            foreach ($results as $result) {
                DB::table($elem)
                    ->where('id',$result->id)
                    ->update(['semester' => str_replace('_', ' ', $result->semester)]);
            }
        }

        Schema::table('housing', function (Blueprint $table) {
            $table->dropIndex('semestre');
            $table->index('semester');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        foreach ($this->tables_with_underscore as $elem) {
            $results = DB::table($elem)->select('id','semester')->get();

            foreach ($results as $result) {
                DB::table($elem)
                    ->where('id',$result->id)
                    ->update(['semester' => str_replace(' ', '_', $result->semester)]);
            }
        }

        foreach ($this->tables_with_semester_not_null as $elem) {
            Schema::table($elem, function (Blueprint $table) {
                $table->string('semester', 20)->nullable(false)->change();
            });
        }

        foreach ($this->tables_with_semestre as $elem) {
            Schema::table($elem, function (Blueprint $table) {
                $table->renameColumn('semester', 'semestre');
            });
        }

    }
}
