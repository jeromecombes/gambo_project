<?php

namespace App\Models;

use App\Models\MyModel;

class CourseChoice extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'courses_choices';

    /**
     * @var array
     */
    protected $fillable = ['student', 'semester', 'a1', 'a2', 'b1', 'b2', 'c1', 'c2', 'd1', 'd2', 'e2'];

}
