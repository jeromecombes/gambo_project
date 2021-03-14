<?php

namespace App;

use app\MyModel;

class HousingTerm extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'housing_accept';
    protected $fillable = ['student', 'semester'];

}
