<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableColumnsToRhCoursesAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_attrib_rh', function (Blueprint $table) {
            $table->integer('writing3')->nullable()->change();
            $table->integer('seminar1')->nullable()->change();
            $table->integer('seminar2')->nullable()->change();
            $table->integer('seminar3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses_attrib_rh', function (Blueprint $table) {
            $table->integer('writing3')->nullable(false)->change();
            $table->integer('seminar1')->nullable(false)->change();
            $table->integer('seminar2')->nullable(false)->change();
            $table->integer('seminar3')->nullable(false)->change();
        });
    }
}
