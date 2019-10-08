<?php

namespace App;

use App\MyModel;

class Univ_reg3 extends MyModel
{
    public function getUniversityAttribute($value)
    {
        return $this->decrypt($value, $this->student);
    }
}
