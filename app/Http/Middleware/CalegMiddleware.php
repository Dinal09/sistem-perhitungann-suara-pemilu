<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalegMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role == 'caleg') {
            return $next($request);
        }
        return redirect('/auth/masuk');
    }
}