<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin/*')) {
            return $next($request);
        }

        // if visitor where created_at = now and ip_address = $request->ip() then return next
        if (Visitor::where('ip_address', $request->ip())->whereDate('created_at', now())->exists()) {
            return $next($request);
        }

        Visitor::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        return $next($request);
    }
}
