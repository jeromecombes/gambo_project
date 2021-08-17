<?php

namespace App\Models;

use App\Models\MyModel;

class Evaluation extends MyModel
{

    /**
     * @var array
     */
    protected $fillable = ['closed', 'courseId', 'form', 'question', 'semester', 'student', 'timestamp'];


    // Set
    public function setResponseAttribute($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        $this->attributes['response'] = $this->encrypt($value, $this->student);
    }

    public function links()
    {
        return $this->hasMany(Evaluation::class, 'timestamp', 'timestamp');
    }

}
