<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHousingDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('housing', function (Blueprint $table) {
            $table->string('semestre', 20)->nullable()->change();
            $table->integer('question')->nullable()->change();
            $table->text('response')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('housing', function (Blueprint $table) {
            $table->string('semestre', 20)->nullable(false)->change();
            $table->integer('question')->nullable(false)->change();
            $table->mediumtext('response')->nullable(false)->change();
        });
    }
}
