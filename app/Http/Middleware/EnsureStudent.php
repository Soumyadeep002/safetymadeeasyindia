<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            session(['url.intended' => $request->fullUrl()]);

            return redirect()->route('auth.google');
        }

        if ($user->is_admin) {
            return redirect()->route('courses')
                ->with('error', 'Please sign in with Google using a student account to enroll.');
        }

        return $next($request);
    }
}
