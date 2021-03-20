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
            $table->string('login', 20)->nullable()->change();
            $table->string('lastname', 50)->nullable()->change();
            $table->string('firstname', 50)->nullable()->change();
            $table->mediumtext('access')->nullable()->change();
            $table->string('university', 25)->nullable()->change();
            $table->string('language', 2)->nullable()->change();
            $table->string('token', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
