<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('students', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('lastname');
             $table->string('firstname');
             $table->string('email')->unique();
             $table->string('token');
             $table->string('password');
             $table->string('semestre');
             $table->mediumtext('dob')->nullable();
             $table->mediumtext('citizenship1')->nullable();
             $table->mediumtext('citizenship2')->nullable();
             $table->mediumtext('town')->nullable();
             $table->mediumtext('university2')->nullable();
             $table->mediumtext('graduation')->nullable();
             $table->mediumtext('resultatTCF')->nullable();
             $table->mediumtext('tin')->nullable();
             $table->string('homeinstitution');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
