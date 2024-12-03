<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        // validate user
        $request->validate(['email' => 'required|email',
        'password'=> 'required']);

        // check if the use exist
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'user not found'
            ], 404);
        }

        // check if the password is correct
        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // generate token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $user,
        ], 200);

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out'
        ], 200);
    }
}
