<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Fetch all users
    public function index()
    {
        // Get all users from the database
        $users = User::all();

        // Return a JSON response with the list of users
        return response()->json($users, 200);
    }
}