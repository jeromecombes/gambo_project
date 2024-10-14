<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnivRegTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('univ_reg', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('semestre', 20);
             $table->integer('question');
             $table->text('response');
         });

         Schema::create('univ_reg2', function (Blueprint $table) {
             $table->bigIncrements('id');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('univ_reg');
        Schema::dropIfExists('univ_reg2');
    }
}
