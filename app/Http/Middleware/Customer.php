<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Customer
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
        $user = $request->user();
        if ($user->userType=='Customer') {
            return $next($request);
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        };
    }
}
