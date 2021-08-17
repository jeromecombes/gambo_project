<?php

namespace App\Models;

use App\Models\MyModel;

class Tutoring extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'tutorat';

    /**
     * @var array
     */
    protected $fillable = ['semester', 'student', 'lock'];

    // Get
    public function getNameAttribute()
    {
        return 'Tutoring';
    }

    public function getTypeAttribute()
    {
        return 'Tutoring';
    }

    public function getProfessorAttribute($value)
    {
        return $this->tutor;
    }

    public function getTutorAttribute($value)
    {
        return $this->decrypt($this->tuteur, false);
    }

    public function getDayAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getStartAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getEndAttribute($value)
    {
        return $this->decrypt($value, false);
    }


    // Set
    public function setTutorAttribute($value)
    {
        $this->attributes['tuteur'] = $this->encrypt($value, false);
    }

    public function setDayAttribute($value)
    {
        $this->attributes['day'] = $this->encrypt($value, false);
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = $this->encrypt($value, false);
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = $this->encrypt($value, false);
    }

}
