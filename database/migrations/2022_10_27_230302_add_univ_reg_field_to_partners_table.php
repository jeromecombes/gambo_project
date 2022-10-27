<?php

use App\Models\Partner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnivRegFieldToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->integer('univreg')->nullable()->after('date');
        });

        $partners = Partner::whereNotIn('id', [5])->get();
        foreach ($partners as $partner) {
            $partner->univreg = 1;
            $partner->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('univreg');
        });
    }
}
