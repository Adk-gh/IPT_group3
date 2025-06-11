<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->profile_completed) {
            // Prevent redirect loop for profile setup pages
            if (!$request->is('profile/setup') && !$request->is('profile/setup/*')) {
                return redirect()->route('profile.setup');
            }
        }

        return $next($request);
    }
}
