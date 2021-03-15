<?php

namespace App;

use App\MyModel;

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