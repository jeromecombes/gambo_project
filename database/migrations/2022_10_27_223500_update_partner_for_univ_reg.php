<?php

use App\Models\UnivReg3;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePartnerForUnivReg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $serie1 = array(
            'Spring 2018',
            'Fall 2018',
            'Spring 2019',
            'Fall 2019',
            'Spring 2020',
            'Fall 2020',
            'Spring 2021',
            'Fall 2021',
            'Spring 2022'
        );

        $replace = array(
            'Paris 3' => 'Sorbonne Nouvelle',
            'Paris 4' => 'Sorbonne Université',
            'Paris 7' => 'Paris Cité',
            'Paris 12' => 'UPEC',
        );

        $keys = array_keys($replace);

        $univReg = UnivReg3::whereNotIn('semester', $serie1)->get();

        foreach ($univReg as $elem) {
            if (in_array($elem->university, $keys)) {
               $elem->university = $replace[$elem->university];
               $elem->save();
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
        $serie1 = array(
            'Spring 2018',
            'Fall 2018',
            'Spring 2019',
            'Fall 2019',
            'Spring 2020',
            'Fall 2020',
            'Spring 2021',
            'Fall 2021',
            'Spring 2022'
        );

        $replace = array(
            'Sorbonne Nouvelle' => 'Paris 3',
            'Sorbonne Université' => 'Paris 4',
            'Paris Cité' => 'Paris 7',
            'UPEC' => 'Paris 12',
        );

        $keys = array_keys($replace);

        $univReg = UnivReg3::whereNotIn('semester', $serie1)->get();

        foreach ($univReg as $elem) {
            if (in_array($elem->university, $keys)) {
               $elem->university = $replace[$elem->university];
               $elem->save();
            }
        }
    }
}
