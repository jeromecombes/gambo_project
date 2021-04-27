<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class MyModel extends Model
{

    protected function encrypt($string, $id = true)
    {
        if ($id === true) {
            $key = $this->id;
        } elseif (is_numeric($id)) {
            $key = $id;
        } else {
            $key = null;
        }

        if($string === null){
            return null;
        }

        $enc_method = 'AES-128-CTR';
        $enc_key = openssl_digest($key.getenv('APP_KEY2'), 'SHA256', TRUE);
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc_method));
        $crypted_string = openssl_encrypt($string, $enc_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
        unset($string, $enc_method, $enc_key, $enc_iv);

        return $crypted_string;
    }

    protected function decrypt($crypted_token, $id = true)
    {
        if ($id === true) {
            $key = $this->id;
        } elseif (is_numeric($id)) {
            $key = $id;
        } else {
            $key = null;
        }

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
        if (!empty($this->day)) {
            return jddayofweek($this->day, 1);
        }

        return null;
    }

    public function getResponseAttribute($value)
    {
        return $this->hasAttribute('response') ? html_entity_decode($this->decrypt($value, $this->student),ENT_QUOTES|ENT_IGNORE, 'UTF-8') : null;
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
