<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Chef
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next):Response
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT logged in'], 401);
        };
        $user = Auth::user();
        if ($user->userType=='Admin') {
            return $next($request);
        };
        if ($user->userType=='Chef') {
            return $next($request);
        };
        if ($user->userType=='Customer') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
        if ($user->userType=='Rider') {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User NOT authorized'], 401);
        };
    }
}
