<?php

namespace App;

use App\MyModel;

class Housing extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'housing';

    public function getresponseAttribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function getsemesterAttribute()
    {
        return str_replace('_', ' ', $this->semestre);
    }
}