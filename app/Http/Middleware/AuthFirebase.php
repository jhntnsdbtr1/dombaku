<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthFirebase
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('firebase_token')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
