<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    private function decrypt($crypted_token, $id = true)
    {

        $key = $id ? $this->id : null;

        if($crypted_token === null){
            return null;
        }

        $decrypted_token = false;

        if(preg_match("/^(.*)::(.*)$/", $crypted_token, $regs)) {
            // decrypt encrypted string
            list(, $crypted_token, $enc_iv) = $regs;
            $enc_method = 'AES-128-CTR';
            $enc_key = openssl_digest($key.getenv('APP_KEY2'), 'SHA256', TRUE);
            $decrypted_token = openssl_decrypt($crypted_token, $enc_method, $enc_key, 0, hex2bin($enc_iv));
            unset($crypted_token, $enc_method, $enc_key, $enc_iv, $regs);
        }
        return $decrypted_token; 
    }

    public function getEmailAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFirstnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getFullnameAttribute()
    {
        return $this->lastname.', '.$this->firstname;
    }

    public function getGenderAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getHome_institutionAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getLastnameAttribute($value)
    {
        return $this->decrypt($value, false);
    }

    public function getUniversity2Attribute($value)
    {
        return $this->decrypt($value);
    }

    public function scopeWithUniv_reg($query)
    {
        $query->leftjoin('univ_reg3', 'univ_reg3.student', '=', 'students.id')
            ->where('univ_reg3.semester', session('semester'))
            ->addSelect('univ_reg3.university as univ_reg');
    }

}