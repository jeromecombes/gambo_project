<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnivRegLock extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'univ_reg_lock1';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['semester', 'student'];
}
