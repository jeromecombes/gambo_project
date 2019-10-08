<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HousingClosed extends Model
{
    /**
     * @var string
     */
    protected $table = 'housing_closed';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['semester', 'student'];
}
