<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthWithBasicToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Auth-Token') !== config('app.api_auth_token')) {
            return response()->json(['message' => 'Unauthorized.'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
