<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LguUserAssignment;

class LguUsersAssignmentController extends Controller
{
    /**
     * Assign an LGU user to an LGU.
     */
    public function assignLguUserToLgu(Request $request)
    {
        $request->validate([
            'lgu_id' => 'required|exists:lgus,id',
            'user_id' => 'required|exists:users,id', // LGU User ID
        ]);

        // Assign the LGU user to the LGU
        $assignment = LguUserAssignment::create([
            'lgu_id' => $request->lgu_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'message' => 'LGU User assigned to LGU successfully',
            'assignment' => $assignment,
        ], 200);
    }
}
