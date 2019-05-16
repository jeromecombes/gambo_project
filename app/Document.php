<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    public $timestamps = false;

    public function getNameAttribute($value)
    {
        return decrypt($value);
    }

    public function getRealnameAttribute($value)
    {
        return decrypt($value);
    }

    public function getSizeAttribute($value)
    {
        $value = decrypt($value);
        
        $ko = $value / 1024;
        $mo = $ko /1024;
        $go = $mo /1024;
        
        if ($go > 1 ) {
            $value = number_format($go, 2).' GB';
        }  elseif ($mo > 1 ) {
            $value = number_format($mo, 2).' MB';
        } elseif ($ko > 1 ) {
            $value = number_format($ko, 2).' KB';
        } else {
            $value = number_format($value, 2).' B';
        }

        return $value;
    }

    public function getTypeAttribute($value)
    {
        return decrypt($value);
    }

    public function getTimeAttribute($value)
    {
        return date(getenv('DATE_FORMAT'), $this->timestamp);
    }

    public function getType2Attribute($value)
    {
        return decrypt($value);
    }

    public function getVisibilityAttribute()
    {
        return $this->adminOnly ? "Admin Only" : null;
    }
}
