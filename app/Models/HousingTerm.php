<?php

namespace App\Models;

use App\Models\MyModel;

class HousingTerm extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'housing_accept';
    protected $fillable = ['student', 'semester'];

}
