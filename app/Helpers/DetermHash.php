<?php
    namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

    class DetermHash {
        public static function check(string $text) {
            if (strlen($text) < 60) {
                return Hash::make($text);
            }
            return $text;
        }
    }
?>