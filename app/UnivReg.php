<?php

namespace App;

use App\MyModel;

class UnivReg extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'univ_reg';

    public function getSemesterAttribute()
    {
        return str_replace('_', ' ', $this->semestre);
    }

    public function setSemesterAttribute($value)
    {
        $this->semestre = str_replace(' ', '_', $value);
    }

}
