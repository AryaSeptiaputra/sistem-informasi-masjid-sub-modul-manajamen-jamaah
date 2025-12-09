<?php

namespace App\Http\Middleware;

use Closure;

class GuestJamaah
{
    public function handle($request, Closure $next)
    {
        if (session()->has('jamaah_id')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
