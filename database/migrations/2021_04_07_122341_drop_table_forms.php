<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('forms');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumtext('question')->nullable();
            $table->string('name', 50)->nullable();
            $table->string('type', 10)->nullable();
            $table->mediumtext('responses')->nullable();
            $table->string('semester', 20)->nullable();
            $table->integer('ordre')->nullable();
            $table->integer('formId');
        });
    }
}
