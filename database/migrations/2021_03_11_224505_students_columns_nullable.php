<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentsColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->mediumtext('lastname')->nullable()->change();
            $table->mediumtext('firstname')->nullable()->change();
            $table->mediumtext('email')->nullable()->change();
            $table->string('token', 200)->nullable()->change();
            $table->mediumtext('password')->nullable()->change();
            $table->string('semestre', 20)->nullable()->change();
            $table->mediumtext('dob')->nullable()->change();
            $table->mediumtext('citizenship1')->nullable()->change();
            $table->mediumtext('citizenship2')->nullable()->change();
            $table->mediumtext('town')->nullable()->change();
            $table->mediumtext('university2')->nullable()->change();
            $table->mediumtext('graduation')->nullable()->change();
            $table->mediumtext('resultatTCF')->nullable()->change();
            $table->mediumtext('tin')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->mediumtext('lastname')->nullable(false)->change();
            $table->mediumtext('firstname')->nullable(false)->change();
            $table->mediumtext('email')->nullable(false)->change();
            $table->string('token', 200)->nullable(false)->change();
            $table->mediumtext('password')->nullable(false)->change();
            $table->string('semestre', 20)->nullable(false)->change();
            $table->mediumtext('dob')->nullable(false)->change();
            $table->mediumtext('citizenship1')->nullable(false)->change();
            $table->mediumtext('citizenship2')->nullable(false)->change();
            $table->mediumtext('town')->nullable(false)->change();
            $table->mediumtext('university2')->nullable(false)->change();
            $table->mediumtext('graduation')->nullable(false)->change();
            $table->mediumtext('resultatTCF')->nullable(false)->change();
            $table->mediumtext('tin')->nullable(false)->change();
        });
    }
}
