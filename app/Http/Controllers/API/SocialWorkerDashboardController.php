<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lgu;
use App\Models\SocialWorkerAssignment;
use App\Models\AssistanceRequest;

class SocialWorkerDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the current authenticated user
        $user = $request->user();

        // Ensure that the user is a social worker
        if ($user->role !== 'social-worker') {
            return response()->json(['message' => 'Access Denied'], 403);
        }

        // Fetch the LGU IDs assigned to the social worker via the social_worker_assignments table
        $assignedLgus = SocialWorkerAssignment::where('user_id', $user->id)->pluck('lgu_id');

        // Fetch assistance requests for LGU users in assigned LGUs
        $assistanceRequests = AssistanceRequest::whereIn('user_id', function($query) use ($assignedLgus) {
            $query->select('user_id')
                  ->from('lgu_user_assignments')
                  ->whereIn('lgu_id', $assignedLgus);  // Correct table and column reference
        })->with('items')->get();

        // Return the data as JSON
        return response()->json([
            'message' => 'Social Worker Dashboard data',
            'assistance_requests' => $assistanceRequests,
        ], 200);
    }
}