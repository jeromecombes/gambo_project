<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampToGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->string('course', 5)->change();
            $table->mediumtext('grade1')->nullable()->change();
            $table->mediumtext('grade2')->nullable()->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->mediumtext('grade1')->nullable(false)->change();
            $table->mediumtext('grade2')->nullable(false)->change();
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
