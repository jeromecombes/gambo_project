<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dates', function (Blueprint $table) {
            $table->mediumtext('date1')->nullable()->change();
            $table->mediumtext('date2')->nullable()->change();
            $table->mediumtext('date3')->nullable()->change();
            $table->mediumtext('date4')->nullable()->change();
            $table->mediumtext('date5')->nullable()->change();
            $table->mediumtext('date6')->nullable()->change();
            $table->mediumtext('date7')->nullable()->change();
            $table->mediumtext('date8')->nullable()->change();
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
        Schema::table('dates', function (Blueprint $table) {
            $table->mediumtext('date1')->nullable(false)->change();
            $table->mediumtext('date2')->nullable(false)->change();
            $table->mediumtext('date3')->nullable(false)->change();
            $table->mediumtext('date4')->nullable(false)->change();
            $table->mediumtext('date5')->nullable(false)->change();
            $table->mediumtext('date6')->nullable(false)->change();
            $table->mediumtext('date7')->nullable(false)->change();
            $table->mediumtext('date8')->nullable(false)->change();
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
