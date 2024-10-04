<?php

namespace App\Http\Middleware;

use App\Traits\BuildResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    use BuildResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!Auth::guard('api')->check()) {
                return $this->buildResponse(401, "Not Authenticated", null, 401);
            }
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->buildResponse(401, "Token is Invalid", null, 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->buildResponse(401, "Token is Expired", null, 401);
            } else {
                return $this->buildResponse(401, "Not Authenticated", null, 401);
            }
        }
        return $next($request);
    }
}
