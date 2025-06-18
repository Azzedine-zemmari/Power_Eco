<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        
        // Check if user has selectedRole property
        if (!isset($user->selectedRole)) {
            return response()->json([
                'message' => 'Unauthorized',
                'error' => 'User role not defined'
            ], 403);
        }

        $userRole = $user->selectedRole;

        // If specific role is required, check if user has that role
        if ($role && $userRole !== $role) {
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