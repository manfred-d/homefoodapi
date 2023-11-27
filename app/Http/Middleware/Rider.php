<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Rider
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

        if ($user->userType=='customer|Customer') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
        if ($user->userType=='chef') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
        if ($user->userType=='rider') {
            return $next($request);
        };
        if ($user->userType=='Admin|admin') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
    }
}
