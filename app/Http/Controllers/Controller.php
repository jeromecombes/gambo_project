<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function cmp_count_desc($a,$b)
    {
        if ($a['type'] == $b['type']) {
            if ($a['count'] == $b['count']) {
                return 0;
            } else {
                return ($a['count'] < $b['count']);
            }
        }
        return ($a['type'] < $b['type']);
    }

    protected function cmp_day($a,$b)
    {
        if (isset($a['start'])) {
            return ($a['day'] . $a['start'] . $a['end'] > $b['day'] . $b['start'] . $b['end']);
        }

        return ($a['day'] > $b['day']);
    }

}
