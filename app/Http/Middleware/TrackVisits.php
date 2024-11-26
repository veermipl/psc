<?php

namespace App\Http\Middleware;

use App\Models\WebHits;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\RateLimiter;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $visitedUrl = $request->fullUrl();

        $key = 'web_hits_' . $ipAddress;

        if (RateLimiter::tooManyAttempts($key, 60)) { //60 in 1 min
            return $next($request);
        }

        RateLimiter::hit($key, 60);

        WebHits::create([
            'ip_address' => $ipAddress,
            'url' => $visitedUrl,
        ]);

        return $next($request);
    }
}
