<?php

namespace App\Models;

use App\Models\MyModel;

class Grade extends MyModel
{

    /**
     * @var array
     */
    protected $fillable = ['course', 'course_id', 'semester', 'student', 'lock'];

    // Get
    public function getDate1Attribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function getDate2Attribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function getGradeAttribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function getGrade1Attribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function getGrade2Attribute($value)
    {
        return $this->decrypt($value, $this->student);
    }

    public function getNoteAttribute($value)
    {
        return $this->decrypt($value, $this->student);
    }


    // Set
    public function setDate1Attribute($value)
    {
        $this->attributes['date1'] = $this->encrypt($value, $this->student);
    }

    public function setDate2Attribute($value)
    {
        $this->attributes['date2'] = $this->encrypt($value, $this->student);
    }

    public function setGradeAttribute($value)
    {
        $this->attributes['grade'] = $this->encrypt($value, $this->student);
    }

    public function setGrade1Attribute($value)
    {
        $this->attributes['grade1'] = $this->encrypt($value, $this->student);
    }

    public function setGrade2Attribute($value)
    {
        $this->attributes['grade2'] = $this->encrypt($value, $this->student);
    }

    public function setNoteAttribute($value)
    {
        $this->attributes['note'] = $this->encrypt($value, $this->student);
    }

}
