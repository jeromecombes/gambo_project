<?php

namespace App\Models;

use App\Models\MyModel;

class RHCourseAssignment extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'courses_attrib_rh';

    /**
     * @var array
     */
    protected $fillable = ['student', 'semester', 'writing1', 'writing2', 'writing3', 'seminar1', 'seminar2', 'seminar3'];

}
