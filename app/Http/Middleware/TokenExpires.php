<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenExpires
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user && $user->token_expires_at && now()->greaterThan($user->token_expires_at)){
            $user->currentAccessToken()->delete();
            return response()->json(['message'=>'Token expired'],401);
        }
        return $next($request);
    }
}
