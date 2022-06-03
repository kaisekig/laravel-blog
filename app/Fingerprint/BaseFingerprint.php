<?php
namespace App\Fingerprint;

use Illuminate\Http\Request;

class BaseFingerprint {
 
    public static function makeFingerprint(Request $request) {
        $ip = $request->ip();
        $ua = $request->userAgent();

        return $ip . $ua;
    }
}

?>