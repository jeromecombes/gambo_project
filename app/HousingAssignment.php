<?php

namespace App;

use app\MyModel;

class HousingAssignment extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'housing_affect';

    public function scopeWithStudents($query)
    {
        $query->leftjoin('students', 'students.id', '=', 'housing_affect.student')
            ->addSelect(array('students.lastname as lastname', 'students.firstname as firstname'));
    }

    public function getLastnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFirstnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getStudentnameAttribute()
    {
        return $this->lastname.' '.$this->firstname;
    }

}
