<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // for admin to create new unique users 
    public function createUser(Request $request){
        $request->validate([
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'selectedRole'=>'required'
        ]);
        $token = Str::random(10);
        $user = User::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password' => Hash::make(Str::random(10)), // Temporary password
            'selectedRole' =>  $request->selectedRole,
            'set_password_token' => $token,
        ]);

        $url = url("/set-password/{$token}");

        Mail::to($user->email)->send(new \App\Mail\SetPasswordMail($url));

        return response()->json(['message' => 'User created and email sent.']);


    }
    // to send the users created by the admin 
    public function setPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'password' => ['required','min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/', 
    ]]);

    $user = User::where('set_password_token', $request->token)->first();

    if (!$user) {
        return response()->json(['message' => 'Invalid or expired token'], 400);
    }

    $user->password = Hash::make($request->password);
    $user->set_password_token = null; // Invalidate token
    $user->status = 'active';
    $user->save();

    return response()->json(['message' => 'Password set successfully.']);
}

    // to show the admin all the user that he register
    public function show(Request $request){
        $perPage = $request->get('per_page', 1);
        $user = User::withTrashed()->where('selectedRole', '!=', 'admin')->paginate($perPage);
        return response()->json($user);
    }
    // to soft delete a user by the admin 
    public function archiveUser(Request $request , int $id){
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        $user->status = 'desactive';
        $user->save();
        $user->delete();

        return response()->json([
            'message' => 'User archived successfully.',
            'user' => $user
        ], 200);
    }
    public function activeUser(Request $request, int $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'User not found.'
        ], 404);
    }

    if ($user->selectedRole !== 'user') {
        return response()->json([
            'message' => 'This action is accessible only for users.'
        ], 403);
    }

    $user->status = 'active';
    $user->save();

    return response()->json([
        'message' => 'User activated successfully.',
        'user' => $user
    ], 200);
}

    // login for all type of users
    public function login(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    if ($user->status !== 'active') {
        return response()->json([
            'message' => 'Your account is not active yet. Please wait for admin approval.'
        ], 403);
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

    public function UserRegistre(Request $request){
        $request->validate([
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'email'=>'required|email',
            'password' => [
                'required',
                'string',
                'min:8', // minimum 8 characters
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        // Check for a soft-deleted user with the same email
        $existingUser = User::withTrashed()->where('email', $request->email)->first();

        if ($existingUser && $existingUser->trashed()) {
            // Restore the user and update their info
            $existingUser->restore();
            $existingUser->firstName = $request->firstName;
            $existingUser->lastName = $request->lastName;
            $existingUser->password = Hash::make($request->password);
            $existingUser->selectedRole = 'user';
            $existingUser->status = 'pending';
            $existingUser->save();

            return response()->json([
                'message' => 'Account restored and registration successful. Please log in.',
            ], 201);
        }

        // If no soft-deleted user, create a new one
        $user = User::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password' =>Hash::make($request->password),
            'selectedRole' =>  'user',
            'status'=>'pending',
            ]);

        return response()->json([
            'message' => 'Registration successful. Please log in.',
        ],201);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=> 'logged out succesfully'
    ]);
    }
    public function forgotPassword(Request $request){
        $request->validate(['email'=>'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset link sent to your email address.'], 200);
        } else {
            return response()->json(['message' => 'Unable to send reset link. Please check your email address and try again.'], 400);
        }
    }
    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/', 
                'regex:/[@$!%*#?&]/', 
            ],        
        ]);
        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),function($user,$password){
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );
        return response()->json(['status' => __($status)]);

    }
    // user data for profile information
    public function getUserData(Request $request){
        $user = $request->user();
        if($user){
            $data = User::find($user->id);
            return response()->json($data);
        }
        return response()->json(['message' => 'User not authenticated.'], 401);
    }

    // update user data
    public function update(Request $request){
        $user = $request->user();
        if($user){
            $request->validate([
                'firstName' => 'sometimes|required|string|max:255',
                'lastName' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            ]);

            $data = User::find($user->id);

            if ($request->has('firstName')) {
                $data->firstName = $request->firstName;
            }
            if ($request->has('lastName')) {
                $data->lastName = $request->lastName;
            }
            if ($request->has('email')) {
                $data->email = $request->email;
            }

            $data->save();

            return response()->json($data);
        }
        return response()->json(['message' => 'User not authenticated.'], 401);
    }
}
