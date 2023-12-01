<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();
        foreach ($user->roles()->get() as $role)
        {
            if ($role->id == 2)//for admin role id is 2
            {
                return $next($request);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }
}
