<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{

    public function registerTestAdminUser(Request $request)
    {
        try {
            // Validate the request including 'role'
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create the user including 'role'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'admin',
            ]);

            return response()->json([
                'message' => 'Admin registered successfully',
                'user' => $user,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'Registration failed due to server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function registerAdminUser(Request $request)
    {
        try {
            // Validate the request including 'role'
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create the user including 'role'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'admin',
            ]);

            return response()->json([
                'message' => 'Admin registered successfully',
                'user' => $user,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'Registration failed due to server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function registerLguUser(Request $request)
    {
        try {
            // Validate the request including 'role'
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create the user including 'role'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'lgu-user',
            ]);

            return response()->json([
                'message' => 'LGU User registered successfully',
                'user' => $user,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'Registration failed due to server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function registerSocialWorker(Request $request)
    {
        try {
            // Validate the request including 'role'
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create the user including 'role'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'social-worker',
            ]);

            return response()->json([
                'message' => 'Social Worker registered successfully',
                'user' => $user,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'Registration failed due to server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function registerDeliveryUser(Request $request)
    {
        try {
            // Validate the request including 'role'
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create the user including 'role'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'delivery-user',
            ]);

            return response()->json([
                'message' => 'Delivery User registered successfully',
                'user' => $user,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'Registration failed due to server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}