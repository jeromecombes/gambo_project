<?php

namespace App;

use App\MyModel;

class Student extends MyModel
{

    public function getCellphoneAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getCitizenship1Attribute($value)
    {
        return $this->decrypt($value);
    }

    public function getCitizenship2Attribute($value)
    {
        return $this->decrypt($value);
    }

    public function getCityAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getContactemailAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getContactfirstAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getContactlastAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getContactmobileAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getContactphoneAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getCountryAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getCountryOBAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getDobAttribute($value)
    {
        return new \DateTime($this->decrypt($value));
    }

    public function getEmailAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFirstnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFrenchNumberAttribute($value)
    {
        return $this->decrypt($value);
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

    public function getLogementAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getNewSemesterAttribute($value)
    {
        $year = intval(substr($this->semesters[0], -4));
        $semester = preg_match('/Fall/', $this->semesters[0]) ? 'Spring ' . ($year + 1) : 'Fall ' . $year;
        return $semester;
    }

    public function getNewSemesterCheckedAttribute($value)
    {
        $checked = in_array($this->newSemester, $this->semesters);
        return $checked;
    }

    public function getPlaceOBAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getResultatTCFAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getSemestersAttribute($value)
    {
        $semesters = unserialize($value);
        sort($semesters);
        return $semesters;
    }

    public function getStateAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getStreetAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getUniversity2Attribute($value)
    {
        return $this->decrypt($value);
    }

    public function getUnivregAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getZipAttribute($value)
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