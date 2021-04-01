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

    public function getNameAttribute($value)
    {
        return html_entity_decode($this->nom);
    }

    public function getDayAttribute($value)
    {
        $day = $this->jour;

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
        return $this->debut;
    }

    public function getEndAttribute($value)
    {
        return $this->fin;
    }

}
