<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;
use App\Models\User;

class AddUserIdToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('user_id')->after('id');
        });

        Student::orderBy('id')->chunk(100, function($students) {
            foreach ($students as $student) {
                $user = User::where('email', $student->email)->first('id');
                if ($user) {
                    $student->user_id = $user->id;
                    $student->user_id = $user->id;
                    $student->save();
                }
            }
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
            $table->dropColumn('user_id');
        });
    }
}
