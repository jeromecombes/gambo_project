<?php

namespace App\Models;

use App\Models\MyModel;
use App\Models\HostAvailable;

class Host extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'logements';

    // Get
    protected function getHosts($semester = null)
    {
        // Get available hosts
        $semester = $semester ?? session('semester');

        $hosts_available = new HostAvailable();
        $hosts_ids = $hosts_available->getIds($semester);

        return $this->whereIn('id', $hosts_ids)->get();
    }

    public function getLastnameAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getLastname2Attribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getFirstnameAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getFirstname2Attribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getAddressAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getZipcodeAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getCityAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getCellphoneAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getCellphone2Attribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getPhonenumberAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getEmailAttribute($value)
    {
        return $this->decrypt($value, null);
    }

    public function getEmail2Attribute($value)
    {
        return $this->decrypt($value, null);
    }

    // Set
    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = $this->encrypt($value, null);
    }

    public function setLastname2Attribute($value)
    {
        $this->attributes['lastname2'] = $this->encrypt($value, null);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = $this->encrypt($value, null);
    }

    public function setFirstname2Attribute($value)
    {
        $this->attributes['firstname2'] = $this->encrypt($value, null);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = $this->encrypt($value, null);
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = $this->encrypt($value, null);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = $this->encrypt($value, null);
    }

    public function setCellphoneAttribute($value)
    {
        $this->attributes['cellphone'] = $this->encrypt($value, null);
    }

    public function setCellphone2Attribute($value)
    {
        $this->attributes['cellphone2'] = $this->encrypt($value, null);
    }

    public function setPhonenumberAttribute($value)
    {
        $this->attributes['phonenumber'] = $this->encrypt($value, null);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $this->encrypt($value, null);
    }

    public function setEmail2Attribute($value)
    {
        $this->attributes['email2'] = $this->encrypt($value, null);
    }


}
