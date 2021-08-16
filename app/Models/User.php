<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\CryptTrait;
use App\Models\Student;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CryptTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'access' => 'array',
    ];

    public function getAccessAttribute($value)
    {
        if (empty($value)) {
            return array();
        }

        return json_decode($value);
    }

    public function setAccessdAttribute($value)
    {
        $this->attributes['access'] = json_encode($value);
    }

    public function getFirstnameAttribute($value)
    {
        if ($this->admin) {
            return $this->decrypt($value, false);
        } else {
            return Student::where('user_id', $this->id)->first()->firstname ?? null;
        }
    }

    public function getDisplayNameAttribute($value)
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getLastnameAttribute($value)
    {
        if ($this->admin) {
            return $this->decrypt($value, false);
        } else {
            return Student::where('user_id', $this->id)->first()->lastname ?? null;
        }
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = $this->encrypt($value, false);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = $this->encrypt($value, false);
    }

}
