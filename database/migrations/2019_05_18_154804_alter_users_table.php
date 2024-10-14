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
//            $table->string('name');
//            $table->string('email')->unique()->change();
//            $table->string('password')->change();
//            $table->rememberToken();
//            $table->timestamps();
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
  //          $table->dropColumn('name');
  //          $table->dropUnique('email');
  //          $table->string('email', 200)->change();
  //          $table->string('password', 200)->change();
  //          $table->dropRememberToken();
  //          $table->dropTimestamps();
        });
    }
}
