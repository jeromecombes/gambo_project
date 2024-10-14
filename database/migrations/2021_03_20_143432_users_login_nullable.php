<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersLoginNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login', 20)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('firstname', 50)->nullable();
            $table->mediumtext('access')->nullable();
            $table->string('university', 25)->nullable();
            $table->string('language', 2)->nullable();
            $table->string('token', 100)->nullable();
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
            $table->dropColumn('login');
            $table->dropColumn('lastname');
            $table->dropColumn('firstname');
            $table->dropColumntext('access');
            $table->dropColumn('university');
            $table->dropColumn('language');
            $table->dropColumn('token');
        });
    }
}
