<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tutoring;

class ChangeDayAttributeOnTutorings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (Tutoring::all() as $tutoring) {
            if (!is_numeric($tutoring->day)) {
                switch ($tutoring->day) {
                    case 'Lundi' : $day = 0; break;
                    case 'Mardi' : $day = 1; break;
                    case 'Mercredi' : $day = 2; break;
                    case 'Jeudi' : $day = 3; break;
                    case 'Vendredi' : $day = 4; break;
                    case 'Samedi' : $day = 5; break;
                    case 'Dimanche' : $day = 6; break;
                    default : $day = null; break;
                }

                $tutoring->day = $day;
                $tutoring->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
