<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->mediumtext('firstname')->nullable();
            $table->mediumtext('lastname')->nullable();
            $table->mediumtext('access')->nullable();
            $table->integer('admin')->nullable();
            $table->integer('alerts')->nullable();
            $table->string('university', 25)->nullable();
            $table->string('language', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('access');
            $table->dropColumn('admin');
            $table->dropColumn('alerts');
            $table->dropColumn('university');
            $table->dropColumn('language');
        });
    }
}
