<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnivRegShow extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'univ_reg_show';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['semester', 'student'];
}
