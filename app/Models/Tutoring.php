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
    public function getTutorAttribute($value)
    {
        return $this->decrypt($this->tuteur, false);
    }

    public function getDayAttribute($value)
    {
        $day = $this->decrypt($value, false);

        if (!is_numeric($day)) {
            switch ($day) {
                case 'Lundi' : return 0; break;
                case 'Mardi' : return 1; break;
                case 'Mercredi' : return 2; break;
                case 'Jeudi' : return 3; break;
                case 'Vendredi' : return 4; break;
                case 'Samedi' : return 5; break;
                case 'Dimanche' : return 6; break;
                default : return null; break;
            }
        }

        return $day;
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
