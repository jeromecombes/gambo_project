<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Http\Traits\CryptTrait;
use App\Mail\Send2FACode;
use Exception;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, CryptTrait;

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

    public function getPartialEmailAttribute($value)
    {
        $tab = explode('@', $this->email);
        $partialEmail = substr($tab[0], 0, -5) . '*****@' . $tab[1];
        return $partialEmail;
    }

    public function setAccessdAttribute($value)
    {
        $this->attributes['access'] = json_encode($value);
    }

    public function getFirstnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getDisplayNameAttribute($value)
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getLastnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = $this->encrypt($value, false);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = $this->encrypt($value, false);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateCode()
    {
        $code = rand(100000, 999999);

        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );

        try {
            Mail::to(auth()->user()->email)->send(new Send2FACode($code));
        } catch (Exception $e) {
            report($e);
        }
    }
}
