<?php

namespace App\Models;

use App\Models\MyModel;

class Housing extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'housing';

    public function getsemesterAttribute()
    {
        return str_replace('_', ' ', $this->semestre);
    }

    public function setsemesterAttribute($value)
    {
        $this->semestre = str_replace(' ', '_', $value);
    }

}