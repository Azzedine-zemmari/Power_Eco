<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return response()->json([
                'message' => 'Unauthorized',
                'error' => 'Authentication required'
            ], 401);
        }

        $user = $request->user();
        
        Log::info('role_id::', ['role_id' => $user->role_id]);
        // Check if user has selectedRole property
        if (!isset($user->role_id)) {
            return response()->json([
                'message' => 'Unauthorized',
                'error' => 'User role not defined'
            ], 403);
        }

        $userRole = $user->role_id;

        // If specific role is required, check if user has that role
        if ($role && $userRole !== (int)$role) {
            return response()->json([
                'message' => 'Unauthorized',
                'error' => 'Insufficient permissions',
                'required_role' => $role,
                'user_role' => $userRole
            ], 403);
        }

        return $next($request);
    }
}