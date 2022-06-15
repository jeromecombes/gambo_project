<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkshopCourseAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_attrib_rh', function (Blueprint $table) {
            $table->integer('workshop1')->nullable()->after('seminar3');
            $table->integer('workshop2')->nullable()->after('workshop1');
            $table->integer('workshop3')->nullable()->after('workshop2');
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
            $table->dropColumn('workshop1');
            $table->dropColumn('workshop2');
            $table->dropColumn('workshop3');
        });
    }
}
