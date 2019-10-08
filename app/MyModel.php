<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    public function decrypt($crypted_token, $id = true)
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
}
