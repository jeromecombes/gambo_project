<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesRH extends Model
{
    /**
     * @var string
     */
    protected $table = 'courses_rh';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['semester', 'student'];
}
