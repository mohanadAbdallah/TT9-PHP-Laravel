<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class validateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('x-api-key');

        if (!$key || $key != config('services.api_key')){
            \Illuminate\Support\Facades\Response::json([
                'message' => 'Missing Or invalid APi key'
            ],401);
        }

        return $next($request);
    }
}
