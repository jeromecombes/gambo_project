<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RHCourseLock extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'courses_rh';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['semester', 'student'];
}
