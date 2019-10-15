<?php

namespace App;

use App\MyModel;

class Host extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'logements';

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


}
