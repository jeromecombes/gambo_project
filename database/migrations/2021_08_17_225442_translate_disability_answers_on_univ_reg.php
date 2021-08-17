<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UnivReg;

class TranslateDisabilityAnswersOnUnivReg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (UnivReg::where('question', 7)->get() as $model) {
            if ($model->response == 'Oui') {
                $model->response = 'Yes';
                $model->save();
            } else if ($model->response == 'Non') {
                $model->response = 'No';
                $model->save();
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
        foreach (UnivReg::where('question', 7)->get() as $model) {
            if ($model->response == 'Yes') {
                $model->response = 'Oui';
                $model->save();
            } else if ($model->response == 'No') {
                $model->response = 'Non';
                $model->save();
            }
        }
    }
}
