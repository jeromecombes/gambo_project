<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccessOnTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $users = DB::table('users')
            ->whereNotNull('access')
            ->get();

        foreach ($users as $u) {

            json_decode($u->access);
            if (json_last_error() == JSON_ERROR_NONE) {
                continue;
            }

            $user = User::find($u->id);
            $user->access = unserialize($u->access);
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $users = User::whereNotNull('access')->get();

        foreach ($users as $u) {

            $accesses = serialize($u->access);

            $user = DB::table('users')
                ->where('id', $u->id)
                ->update(['access' => $accesses]);
        }
    }
}
