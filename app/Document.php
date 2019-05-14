<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    private function decrypt($crypted_token)
    {
        $key = $this->student;
        
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

    public function getNameAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getRealnameAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function getSizeAttribute($value)
    {
        $value = $this->decrypt($value);
        
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
        return $this->decrypt($value);
    }

    public function getType2Attribute($value)
    {
        return $this->decrypt($value);
    }
}
