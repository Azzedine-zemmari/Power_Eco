<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Log;

class TokenExpires
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        Log::info('TokenExpires middleware hit', [
            'user_id' => $user?->id,
            'now' => now()->toDateTimeString(),
            'token_expires_at' => $user?->token_expires_at ? $user->token_expires_at->toDateTimeString() : null
        ]);

        if ($user && $user->token_expires_at && now()->greaterThan($user->token_expires_at)) {
            Log::info('Token expired. Deleting token.', [
                'user_id' => $user->id,
                'now' => now()->toDateTimeString(),
                'token_expires_at' => $user->token_expires_at->toDateTimeString()
            ]);

            $user->currentAccessToken()?->delete();
            $user->token_expires_at = null;
            $user->save();

            return response()->json([
                'message' => 'Token expired. Please log in again.'
            ], 401);
        }

        return $next($request);
    }
}

