<?php

namespace App\Models;

use App\Models\MyModel;

class UnivCourse extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'courses_univ4';

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'nom',
        'nature',
        'lien',
        'institution',
        'institutionAutre',
        'discipline',
        'niveau',
        'prof',
        'email',
        'jour',
        'debut',
        'fin',
        'note',
        'modalites',
        'modalites1',
        'modalites2',
        'semester',
        'student',
        'lock'
    ];

    // Get
    public function getCodeAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getNomAttribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    public function getNatureAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getInstitutionAttribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    public function getInstitutionAutreAttribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    public function getDisciplineAttribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    public function getNiveauAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getProfAttribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    public function getEmailAttribute($value)
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

    public function getModalitesAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getModalites1Attribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    public function getModalites2Attribute($value)
    {
        return str_replace('&#039;', "'", html_entity_decode($this->decrypt($value, false)));
    }

    // Set
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = $this->encrypt($value);
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = $this->encrypt($value);
    }

    public function setNatureAttribute($value)
    {
        $this->attributes['nature'] = $this->encrypt($value);
    }

    public function setInstitutionAttribute($value)
    {
        $this->attributes['institution'] = $this->encrypt($value);
    }

    public function setInstitutionAutreAttribute($value)
    {
        $this->attributes['institutionAutre'] = $this->encrypt($value);
    }

    public function setDisciplineAttribute($value)
    {
        $this->attributes['discipline'] = $this->encrypt($value);
    }

    public function setNiveauAttribute($value)
    {
        $this->attributes['niveau'] = $this->encrypt($value);
    }

    public function setProfAttribute($value)
    {
        $this->attributes['prof'] = $this->encrypt($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $this->encrypt($value);
    }

    public function setJourAttribute($value)
    {
        $this->attributes['jour'] = $this->encrypt($value);
    }

    public function setDebutAttribute($value)
    {
        $this->attributes['debut'] = $this->encrypt($value);
    }

    public function setFinAttribute($value)
    {
        $this->attributes['fin'] = $this->encrypt($value);
    }

    public function setModalitesAttribute($value)
    {
        $this->attributes['modalites'] = $this->encrypt($value);
    }

    public function setModalites1Attribute($value)
    {
        $this->attributes['modalites1'] = $this->encrypt($value);
    }

    public function setModalites2Attribute($value)
    {
        $this->attributes['modalites2'] = $this->encrypt($value);
    }

}
