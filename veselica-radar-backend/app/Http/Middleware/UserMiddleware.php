<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = ['user'];

        try {
            $user = $this->auth->guard('sanctum')->user();
        } catch (AuthenticationException $e) {
            return \response()->json(['error' => 'Authorization failed with sanctum user'], 401);
        }

        if (!$user || !in_array($request->input('role'), $roles)) {
            return response()->json(['error' => 'Unauthorized - you dont have a user role'], 401);
        }

        return $next($request);
    }
}
