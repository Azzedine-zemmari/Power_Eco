<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // for admin to create new unique users 
    public function register(Request $request){
        $request->validate([
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6',
            'selectedRole'=>'required'
        ]);
        $user = User::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password' =>Hash::make($request->password),
            'selectedRole' =>  $request->selectedRole
        ]);

        return response()->json([
            'user'=>$user
        ],201);

    }
    // to show the admin all the user that he register
    public function show(){
        $user = User::whereNotIn('selectedRole', ['user', 'admin'])->get();
        return response()->json($user);
    }
    // to login as admin
    public function login(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Revoke previous tokens if needed
    $user->tokens()->delete();

    // Create new token
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'role' => $user->selectedRole,
        'token' => $token
    ], 200);
}

}
