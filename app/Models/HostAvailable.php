<?php

namespace App\Models;

use App\Models\MyModel;

class HostAvailable extends MyModel
{
    /**
     * @var string
     */
    protected $table = 'logements_dispo';

    private $semester;

    public function getIds($semester = null)
    {

        $semester = $semester ?? session('semester');

        $this->semester = str_replace(array('Spring', 'Fall'), array('1', '2'), preg_replace('/(\w+) (\d+)/', "$2$1", $semester));

        $hosts_available = $this::where(function ($query) {
            $query->where('end', '>=', $this->semester)
                ->orWhere('end', '=', 0);
            })->where('start', '<=', $this->semester)
            ->get();

        $hosts_ids = array();

        foreach ($hosts_available as $h) {
            $hosts_ids[] = $h->logement_id;
        }

        return $hosts_ids;
    }

    // Set
    public function setHostAttribute($value)
    {
        $this->attributes['logement_id'] = $value;
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = str_replace(array('Spring', 'Fall'), array('1', '2'), preg_replace('/(\w+) (\d+)/', "$2$1", $value));
    }

    public function setEndAttribute($value)
    {
        $year = (int) preg_replace('/(\w+) (\d+)/', "$2", $value);
        $semester = preg_replace('/(\w+) (\d+)/', "$1", $value);

        if ($semester == 'Spring') {
            $year--;
            $semester = 2;
        } else {
            $semester = 1;
        }

        $this->attributes['end'] = "$year"."$semester";
    }


}
