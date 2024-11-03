<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssistanceRequest;

class LguDashboardController extends Controller
{
    public function index(Request $request)
    {
        /// Get the current authenticated user
        $user = $request->user();

        // Fetch all assistance requests for this user
        $assistanceRequests = AssistanceRequest::where('user_id', $user->id)
            ->with('items') // Load the related items as well
            ->get();

        // Return the assistance requests as JSON
        return response()->json([
            'message' => 'LGU Dashboard data',
            'assistance_requests' => $assistanceRequests,
        ], 200);
    }
}
