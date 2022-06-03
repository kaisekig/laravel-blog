<?php

namespace App\Http\Middleware;

use App\Fingerprint\BaseFingerprint;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $fingerprint = BaseFingerprint::makeFingerprint($request);

        $hash        = $request->session()->exists("fingerprint");
        if (!$hash) {
            $request->session()->flush();

            throw new HttpException(401, "Unauthorized!");
            return;
        }

        $hash = $request->session()->get("fingerprint");
        if (!Hash::check($fingerprint, $hash)) {
            # DELETE SESSION AND ALL DATA
            
            $request->session()->flush();

            throw new HttpException(401, "Unauthorized!");
            return;
        }

        return $next($request);
    }
}
