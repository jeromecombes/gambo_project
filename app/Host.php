<?php

namespace App;

use App\MyModel;
use App\HostAvailable;

class Host extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'logements';

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


}
