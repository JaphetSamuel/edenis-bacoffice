<?php

namespace App\Helpers;

class TokenHelper
{
    public static function generateToken($length = 6)
    {
        // generate a 6 digit otp number
        $generator = "1357902468";
        $token = "";
        for ($i = 1; $i <= $length; $i++) {
            $token .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $token;
    }
}
