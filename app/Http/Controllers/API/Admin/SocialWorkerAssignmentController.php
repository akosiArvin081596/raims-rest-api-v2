<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialWorkerAssignment;

class SocialWorkerAssignmentController extends Controller
{
    public function assignSocialWorkerToLgu(Request $request)
    {
        $request->validate([
            'lgu_id' => 'required|exists:lgus,id',
            'user_id' => 'required|exists:users,id', // Social Worker ID
        ]);

        // Assign the social worker to the LGU
        $assignment = SocialWorkerAssignment::create([
            'lgu_id' => $request->lgu_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'message' => 'Social Worker assigned to LGU successfully',
            'assignment' => $assignment,
        ], 200);
    }
}
