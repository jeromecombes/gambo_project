<?php

namespace App\Models;

use App\Models\MyModel;

class EvaluationEnabled extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'eval_enabled';

    /**
     * @var array
     */
    protected $fillable = ['semester'];

}
