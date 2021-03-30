<?php

namespace App\Models;

use App\Models\MyModel;

class Internship extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'stages';

    /**
     * @var array
     */
    protected $fillable = ['internship', 'semester', 'student', 'lock'];

    // Get
    public function getNameAttribute($value)
    {
        return $this->decrypt($this->stage, $this->student);
    }

    public function getNotesAttribute($value)
    {
        return $this->decrypt($value, $this->student);
    }


    // Set
    public function setNameAttribute($value)
    {
        $this->attributes['stage'] = $this->encrypt($value, $this->student);
    }

    public function setNotesAttribute($value)
    {
        $this->attributes['notes'] = $this->encrypt($value, $this->student);
    }

}
