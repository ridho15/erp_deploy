<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptController extends Controller
{
    public function crypt($string, $action = 'e')
    {
        $secret_key = 'mitraglobalkenca';

        // $secret_iv = 'buk1tt1ngg1m4ju4';
        $secret_iv = 'm1tr4Gl0b4lk3nc@';

        $output = false;

        $encrypt_method = "AES-128-CBC";

        $iv = substr($secret_iv, 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $secret_key, 0, $iv));
        } elseif ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $secret_key, 0, $iv);
        }

        return $output;
    }
}
