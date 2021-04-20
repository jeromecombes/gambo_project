<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->mediumtext('professor')->nullable()->change();
            $table->mediumtext('title')->nullable()->change();
            $table->string('type', 20)->nullable()->change();
            $table->string('semester', 20)->nullable()->change();
            $table->mediumtext('nom')->nullable()->change();
            $table->mediumtext('code')->nullable()->change();
            $table->mediumtext('jour')->nullable()->change();
            $table->mediumtext('debut')->nullable()->change();
            $table->mediumtext('fin')->nullable()->change();
            $table->dropColumn('univ');
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
        Schema::table('courses', function (Blueprint $table) {
            $table->mediumtext('professor')->nullable(false)->change();
            $table->mediumtext('title')->nullable(false)->change();
            $table->string('type', 20)->nullable(false)->change();
            $table->string('semester', 20)->nullable(false)->change();
            $table->string('univ', 20)->nullable(false)->after('semester');
            $table->mediumtext('nom')->nullable(false)->change();
            $table->mediumtext('code')->nullable(false)->change();
            $table->mediumtext('jour')->nullable(false)->change();
            $table->mediumtext('debut')->nullable(false)->change();
            $table->mediumtext('fin')->nullable(false)->change();
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
