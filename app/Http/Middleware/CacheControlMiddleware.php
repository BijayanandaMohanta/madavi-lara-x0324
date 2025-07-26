<?php

namespace App\Http\Middleware;

use Closure;

class CacheControlMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->is('frontend/assets/css/*') || $request->is('frontend/assets/js/*') || $request->is('frontend/assets/fonts/*')) {
            $maxAge = env('CACHE_CONTROL_MAX_AGE', 31536000); // Default to 1 year if not set
            $response->headers->set('Cache-Control', 'public, max-age=' . $maxAge);
        }

        return $response;
    }
}