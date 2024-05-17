<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $roles = ['admin', 'waiter'];

        try {
            $user = $this->auth->guard('sanctum')->user();
        } catch (AuthenticationException $e) {
            return response()->json(['error' => 'Unauthorized', 'exceptionErr' => $e->getMessage()], 401);
        }

        if (!$user || !in_array($request->input('role'), $roles)) {
            return response()->json(['error' => 'Unauthorized access to this route', 'role' => $request->input('role'),'roles' => $roles], 403);
        }

        return $next($request);


        /*if (!$user || !in_array($user->role, $roles)) {
            return \response()->json(
                ['Error' =>'Unauthorized access to this route',
                 'user' => $user], 403);
        }

        return $next($request);*/
    }
}
