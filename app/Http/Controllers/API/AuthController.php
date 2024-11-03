<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Include the Auth facade
use App\Models\User;

class AuthController extends Controller
{
    // Login method
    public function login(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user using Auth::attempt
        if (!Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            // Return a 401 Unauthorized response if credentials are invalid
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Generate the token via the generateToken() method
        $token = $this->generateToken($user);

        // Return the token and user information
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    // Token generation logic is separated for reusability
    private function generateToken(User $user)
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    // Logout method
    public function logout(Request $request)
    {
        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
