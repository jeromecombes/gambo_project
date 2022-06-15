<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkshopCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_choices', function (Blueprint $table) {
            $table->integer('a3')->nullable()->after('a2');
            $table->integer('b3')->nullable()->after('b2');
            $table->integer('c3')->nullable()->after('c2');
            $table->integer('d3')->nullable()->after('d2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses_choices', function (Blueprint $table) {
            $table->dropColumn('a3');
            $table->dropColumn('b3');
            $table->dropColumn('c3');
            $table->dropColumn('d3');
        });
    }
}
