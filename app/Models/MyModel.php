<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Http\Traits\CryptTrait;

class MyModel extends Model
{

    use CryptTrait;

    protected function getMe()
    {
        $object = $this::where('student', session('student'))
            ->where('semester', session('semester'))
            ->orderBy('created_at','asc')
            ->get();

        return $object;
    }

    protected function findMe()
    {
        $object = $this::where('student', session('student'))
            ->where('semester', session('semester'))
            ->first();

        return $object;
    }

    protected function findOrCreateMe()
    {
        $object = $this::firstOrNew([
            'student' => session('student'),
            'semester' => session('semester'),
        ]);

        return $object;
    }

    public function getDayTextAttribute()
    {
        if (isset($this->day) and is_numeric($this->day)) {
            return jddayofweek($this->day, 1);
        }

        return null;
    }

    public function getDisplayNameAttribute($value)
    {
        if ($this->hasAttribute('firstname') and $this->hasAttribute('lastname')) {
            return $this->firstname . ' ' . $this->lastname;
        }

        return null;
    }

    public function getResponseAttribute($value)
    {
        return $this->hasAttribute('response') ? $this->decrypt($value, $this->student) : null;
    }

    public function setResponseAttribute($value)
    {
        if ($this->hasAttribute('response')) {
            $this->attributes['response'] = $this->encrypt($value, $this->student);
        }
    }

    public function std()
    {
        return $this->hasAttribute('student') ? $this->hasOne(Student::class, 'id', 'student') : null;
    }

    public function hasAttribute($attr)
    {
        return Schema::hasColumn($this->getTable(), $attr);
    }
}
