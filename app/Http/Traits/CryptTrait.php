<?php

namespace App\Http\Traits;

trait CryptTrait {

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
}
