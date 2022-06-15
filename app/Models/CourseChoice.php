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
    protected $fillable = ['student', 'semester', 'a1', 'a2', 'a3', 'b1', 'b2', 'b3', 'c1', 'c2', 'c3', 'd1', 'd2', 'd3', 'e2'];

}
