<?php

namespace App\Http\Middleware;

use Closure;

class AuthJamaah
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('jamaah_id')) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        return $next($request);
    }
}
