<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('admin.login')->with('error', 'অ্যাডমিন অ্যাক্সেস প্রয়োজন।');
        }

        return $next($request);
    }
}
