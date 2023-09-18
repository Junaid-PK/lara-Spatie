<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Register User
    */
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];
        $role = 'user';

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);        

        if(! $user){
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);    
        }
        return response()->json([
            'message' => 'Registeration Successfull',
            'user' => $user,
        ], 200);
    }

    /**
     * Login User
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $email = $request['email'];
        $password = $request['password'];

        // Authenticate
        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Please Enter Valid Credentials'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'message' => 'Login Successfull',
            'token' => $token,
        ], 200); 
    }

    /**
     * Logout the user
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout Successfull'],200);
    }

    public function getUsers()
    {
        return User::all();
    }

}
