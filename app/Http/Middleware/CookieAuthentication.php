<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CookieAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get token from cookie
        $token = $request->cookie('auth_token');
        
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Find the token in the database
        $accessToken = PersonalAccessToken::findToken($token);
        
        if (!$accessToken) {
            return response()->json(['message' => 'Invalid token.'], 401);
        }

        // Check if token is expired
        if ($accessToken->expires_at && now()->gt($accessToken->expires_at)) {
            $accessToken->delete();
            return response()->json(['message' => 'Token expired.'], 401);
        }

        // Get the user
        $user = $accessToken->tokenable;
        
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 401);
        }

        // Set the user on the request
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
} 