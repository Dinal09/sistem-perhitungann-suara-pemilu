<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin') {
            return $next($request);
        }
        return redirect('/auth/masuk');
    }
}