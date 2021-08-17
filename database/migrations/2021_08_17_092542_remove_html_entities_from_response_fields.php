<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Evaluation;
use App\Models\Housing;
use App\Models\UnivReg;
use App\Models\UnivReg2;

class RemoveHtmlEntitiesFromResponseFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (Evaluation::all() as $model) {
            $old = $model->response;
            $new = str_replace('&#039;', "'", html_entity_decode($old,ENT_QUOTES|ENT_IGNORE, 'UTF-8'));

            if ($new != $old) {
                $model->response = $new;
                $model->save();
            }
        }

        foreach (Housing::all() as $model) {
            $old = $model->response;
            $new = str_replace('&#039;', "'", html_entity_decode($old,ENT_QUOTES|ENT_IGNORE, 'UTF-8'));

            if ($new != $old) {
                $model->response = $new;
                $model->save();
            }
        }

        foreach (UnivReg::all() as $model) {
            $old = $model->response;
            $new = str_replace('&#039;', "'", html_entity_decode($old,ENT_QUOTES|ENT_IGNORE, 'UTF-8'));

            if ($new != $old) {
                $model->response = $new;
                $model->save();
            }
        }

        foreach (UnivReg2::all() as $model) {
            $old = $model->response;
            $new = str_replace('&#039;', "'", html_entity_decode($old,ENT_QUOTES|ENT_IGNORE, 'UTF-8'));

            if ($new != $old) {
                $model->response = $new;
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
        //
    }
}
