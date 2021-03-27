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
        'lien',
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

    public function getNoteAttribute($value)
    {
        if ($value == 0 or $value == 2) {
            return 'No';
        }

        if ($value == 1) {
            return 'Yes';
        }

        return $value;
    }

    // Set
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = $this->encrypt($value, false);
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = $this->encrypt($value, false);
    }

    public function setNatureAttribute($value)
    {
        $this->attributes['nature'] = $this->encrypt($value, false);
    }

    public function setInstitutionAttribute($value)
    {
        $this->attributes['institution'] = $this->encrypt($value, false);
    }

    public function setInstitutionAutreAttribute($value)
    {
        $this->attributes['institutionAutre'] = $this->encrypt($value, false);
    }

    public function setDisciplineAttribute($value)
    {
        $this->attributes['discipline'] = $this->encrypt($value, false);
    }

    public function setNiveauAttribute($value)
    {
        $this->attributes['niveau'] = $this->encrypt($value, false);
    }

    public function setProfAttribute($value)
    {
        $this->attributes['prof'] = $this->encrypt($value, false);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $this->encrypt($value, false);
    }

    public function setJourAttribute($value)
    {
        $this->attributes['jour'] = $this->encrypt($value, false);
    }

    public function setDebutAttribute($value)
    {
        $this->attributes['debut'] = $this->encrypt($value, false);
    }

    public function setFinAttribute($value)
    {
        $this->attributes['fin'] = $this->encrypt($value, false);
    }

    public function setModalitesAttribute($value)
    {
        $this->attributes['modalites'] = $this->encrypt($value, false);
    }

    public function setModalites1Attribute($value)
    {
        $this->attributes['modalites1'] = $this->encrypt($value, false);
    }

    public function setModalites2Attribute($value)
    {
        $this->attributes['modalites2'] = $this->encrypt($value, false);
    }

    public function setNoteAttribute($value)
    {
        if ($value == 'Yes') {
            $value = 1;
        } elseif ($value == 'No') {
            $value = 2;
        } else {
            $value = 0;
        }

        $this->attributes['note'] = $value;
    }

    // Links
    public function links()
    {
        return $this->hasMany(UnivCourse::class, 'lien', 'id');
    }

    public function link()
    {
        return $this->belongsTo(UnivCourse::class, 'lien', 'id');
    }

}
