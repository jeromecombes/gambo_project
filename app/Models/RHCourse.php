<?php

namespace App\Models;

use App\Models\MyModel;

class RHCourse extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'courses';

    /**
     * @var array
     */
    protected $fillable = ['type', 'semester'];

    // Get
    public function getProfessorAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getTitleAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getUnivAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getNomAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getCodeAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getDebutAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFinAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getNameAttribute($value)
    {
        return $this->title;
    }

    public function getDayAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getStartAttribute($value)
    {
        return $this->debut;
    }

    public function getEndAttribute($value)
    {
        return $this->fin;
    }

    // Set

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = $this->encrypt($value, false);
    }

    public function setDayAttribute($value)
    {
        $this->attributes['day'] = $this->encrypt($value, false);
    }

    public function setEndAttribute($value)
    {
        $this->attributes['fin'] = $this->encrypt($value, false);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['title'] = $this->encrypt($value, false);
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = $this->encrypt($value, false);
    }

    public function setProfessorAttribute($value)
    {
        $this->attributes['professor'] = $this->encrypt($value, false);
    }

    public function setStartAttribute($value)
    {
        $this->attributes['debut'] = $this->encrypt($value, false);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $this->encrypt($value, false);
    }

}
