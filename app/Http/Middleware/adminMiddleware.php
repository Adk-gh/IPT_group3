<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // First check if user is authenticated
        if (!Auth::check()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthenticated'], 401)
                : redirect()->route('login');
        }

        // Then check for admin email
        if (Auth::user()->email !== 'admin@gmail.com') {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthorized'], 403)
                : redirect()->route('home')->with('error', 'Admin access required');
        }

        return $next($request);
    }
}
