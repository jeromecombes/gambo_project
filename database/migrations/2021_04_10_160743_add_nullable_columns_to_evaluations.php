<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableColumnsToEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->integer('student')->nullable()->change();
            $table->string('form', 20)->nullable()->change();
            $table->integer('courseId')->nullable()->change();
            $table->integer('timestamp')->nullable()->change();
            $table->integer('question')->nullable()->change();
            $table->mediumtext('response')->nullable()->change();
            $table->integer('closed')->nullable()->change();
            $table->string('semester', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->integer('student')->nullable(false)->change();
            $table->string('form', 20)->nullable(false)->change();
            $table->integer('courseId')->nullable(false)->change();
            $table->integer('timestamp')->nullable(false)->change();
            $table->integer('question')->nullable(false)->change();
            $table->mediumtext('response')->nullable(false)->change();
            $table->integer('closed')->nullable(false)->change();
            $table->string('semester', 20)->nullable(false)->change();
        });
    }
}
