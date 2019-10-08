<?php

namespace App;

use App\MyModel;

class Student extends MyModel
{

    public function getEmailAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFirstnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFullnameAttribute()
    {
        return $this->lastname.', '.$this->firstname;
    }

    public function getGenderAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getHome_institutionAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getLastnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getUnivregAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getUniversity2Attribute($value)
    {
        return $this->decrypt($value);
    }

    public function setUnivregAttribute($value)
    {
        $this->univreg = $value;
    }

    public function scopeWithUniv_reg($query)
    {
        $query->leftjoin('univ_reg3s', 'univ_reg3s.student', '=', 'students.id')
            ->addSelect('univ_reg3s.university as univreg');
    }

}