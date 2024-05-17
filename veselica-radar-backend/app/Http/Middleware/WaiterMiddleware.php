<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WaiterMiddleware
{

    protected $auth;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $roles = ['waiter'];

        try {
            $user = $this->auth->guard('sanctum')->user();
        } catch (AuthenticationException $e) {
            return \response()->json(['error' => 'Authorization failed with sanctum user'], 401);
        }

        if (!$user || !in_array($request->input('role'), $roles)) {
            return response()->json(['error' => 'Unauthorized - you do not have waiter role'], 401);
        }


        return $next($request);
    }
}
