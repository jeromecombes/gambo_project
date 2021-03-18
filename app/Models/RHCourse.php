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
    protected $fillable = ['professor', 'title', 'type', 'semester', 'univ', 'nom', 'code', 'jour', 'debut', 'fin'];

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

    public function getJourAttribute($value)
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

}
