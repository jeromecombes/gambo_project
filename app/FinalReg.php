<?php

namespace App;

use App\MyModel;

class FinalReg extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'univ_reg3s';
    protected $fillable = ['student', 'semester', 'university'];

    public function getUniversityAttribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function setUniversityAttribute($value)
    {
        $this->attributes['university'] = $this->encrypt($value, $this->student);
    }

}
