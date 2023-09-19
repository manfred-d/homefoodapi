<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Chef
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT logged in'], 401);
        };
        $user = Auth::user();
        if ($user->userType=='admin|Admin') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
        if ($user->userType=='chef') {
            return $next($request);
        };
        if ($user->userType=='customer|Customer') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
        if ($user->userType=='rider') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
    }
}
