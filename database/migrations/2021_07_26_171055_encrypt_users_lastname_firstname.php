<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Traits\CryptTrait;

class EncryptUsersLastnameFirstname extends Migration
{
    use CryptTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->mediumtext('firstname')->change();
            $table->mediumtext('lastname')->change();
        });

        DB::table('users')->orderBy('id')->chunk(100, function($users) {
            foreach ($users as $user) {

                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'firstname' => $this->encrypt($user->firstname, false),
                        'lastname' => $this->encrypt($user->lastname, false),
                        'name' => null,
                    ]);
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 50)->change();
            $table->string('lastname', 50)->change();
        });

        DB::table('users')->orderBy('id')->chunk(100, function($users) {
            foreach ($users as $user) {

                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'firstname' => $this->decrypt($user->firstname, false),
                        'lastname' => $this->decrypt($user->lastname, false),
                    ]);
            }
        });
    }
}
