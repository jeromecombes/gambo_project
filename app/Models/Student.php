<?php

namespace App\Models;

use App\Models\MyModel;

class Student extends MyModel
{

    // Get

    public function getAddressAttribute($value)
    {
        $tab = array();

        if ($this->street) {
            $tab[] = $this->street;
        }
        if ($this->city) {
            $tab[] = $this->city;
        }
        if ($this->state) {
            $tab[] = $this->state;
        }
        if ($this->country) {
            $tab[] = $this->country;
        }

        $address = join(", ",$tab);

        return $address;
    }

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
        $dob = $this->decrypt($value);

        if (empty($dob)) {
            return null;
        }

        $dob = new \DateTime($dob);

        return $dob->format('M d, Y');
    }

    public function getDayAttribute($value)
    {
        if (!$this->dob) {
            return null;
        }

        $dob = new \DateTime($this->dob);

        return $dob->format('d');
    }

    public function getMonthAttribute($value)
    {
        if (!$this->dob) {
            return null;
        }

        $dob = new \DateTime($this->dob);

        return $dob->format('n');
    }

    public function getYearAttribute($value)
    {
        if (!$this->dob) {
            return null;
        }

        $dob = new \DateTime($this->dob);

        return $dob->format('Y');
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

    // Set

    public function setCellphoneAttribute($value)
    {
        $this->attributes['cellphone'] = $this->encrypt($value);
    }

    public function setCitizenship1Attribute($value)
    {
        $this->attributes['citizenship1'] = $this->encrypt($value);
    }

    public function setCitizenship2Attribute($value)
    {
        $this->attributes['citizenship2'] = $this->encrypt($value);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = $this->encrypt($value);
    }

    public function setContactemailAttribute($value)
    {
        $this->attributes['contactemail'] = $this->encrypt($value);
    }

    public function setContactfirstAttribute($value)
    {
        $this->attributes['contactfirst'] = $this->encrypt($value);
    }

    public function setContactlastAttribute($value)
    {
        $this->attributes['contactlast'] = $this->encrypt($value);
    }

    public function setContactmobileAttribute($value)
    {
        $this->attributes['contactmobile'] = $this->encrypt($value);
    }

    public function setContactphoneAttribute($value)
    {
        $this->attributes['contactphone'] = $this->encrypt($value);
    }

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = $this->encrypt($value);
    }

    public function setCountryOBAttribute($value)
    {
        $this->attributes['countryOB'] = $this->encrypt($value);
    }

    public function setDobAttribute($value)
    {
        if (empty($value)) {
            $dob = null;

        } else {
            $dob = new \DateTime($value);
            $dob = $dob->format('Y-m-d');
        }

        $this->attributes['dob'] = $this->encrypt($dob);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $this->encrypt($value, false);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = $this->encrypt($value, false);
    }

    public function setFrenchNumberAttribute($value)
    {
        $this->attributes['frenchNumber'] = $this->encrypt($value);
    }

    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = $this->encrypt($value);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = $this->encrypt($value, false);
    }

    public function setLogementAttribute($value)
    {
        $this->attributes['logement'] = $this->encrypt($value);
    }

    public function setPlaceOBAttribute($value)
    {
        $this->attributes['placeOB'] = $this->encrypt($value);
    }

    public function setResultatTCFAttribute($value)
    {
        $this->attributes['resultatTCF'] = $this->encrypt($value);
    }

    public function setSemestersAttribute($value)
    {
        $this->attributes['semesters'] = serialize($value);
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = $this->encrypt($value);
    }

    public function setStreetAttribute($value)
    {
        $this->attributes['street'] = $this->encrypt($value);
    }

    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = md5($value);
    }

    public function setUniversity2Attribute($value)
    {
        $this->attributes['university2'] = $this->encrypt($value);
    }

    public function setZipAttribute($value)
    {
        $this->attributes['zip'] = $this->encrypt($value);
    }

    //

    public function setUnivregAttribute($value)
    {
        $this->univreg = $value;
    }

    //

    public function scopeWithUniv_reg($query)
    {
        $query->leftjoin('univ_reg3s', 'univ_reg3s.student', '=', 'students.id')
            ->addSelect('univ_reg3s.university as univreg');
    }

    public static function findMine($fields = null)
    {
        $user = auth()->user();

        $semester = session('semester');

        if ($user->university == 'VWPP') {
            $students = self::where('semesters', 'like', "%$semester%")->get();
        } else {
            $students = self::where('semesters', 'like', "%$semester%")
                ->where('university', $user->university)
                ->get();
        }

        if (is_string($fields)) {
            $tab = array();
            foreach ($students as $student) {
                $tab[] = $student->$fields;
            }
            return $tab;
        }

        return $students;
    }
}
