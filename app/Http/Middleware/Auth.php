<?php

namespace App\Http\Middleware;

use Closure;
use JWT;

class Auth
{
    public function handle($request, Closure $next)
    {
        // try to load incofmation in token

        if (!JWT::parseToken()) {
            return response()->json([
                'message' => 'token is invalid'
            ], 401);
        }


        // pass the authenticate
        return $next($request);
    }
}
