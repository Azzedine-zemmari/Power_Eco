<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        $user = User::all();
        return response()->json([
            'user'=>$user
        ]);
    }
}
