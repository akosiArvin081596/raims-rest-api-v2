<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lgu;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addNewLgu(Request $request)
    {
        // Validate the input with uniqueness check for 'lgu_name' and 'province'
        $request->validate([
            'lgu_name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        // Check if the LGU already exists
        $existingLgu = Lgu::where('lgu_name', $request->lgu_name)
                            ->where('province', $request->province)
                            ->first();

        if ($existingLgu) {
            // If an LGU with the same city/municipality and province exists, return an error
            return response()->json([
                'message' => 'The LGU with the same name and province already exists.'
            ], 422); // HTTP 422 Unprocessable Entity
        }
        $lgu = Lgu::create([
            'lgu_name' => $request->lgu_name,
            'province' => $request->province,
        ]);

        return response()->json(['message' => 'LGU added successfully', 'lgu' => $lgu], 201);
    }

    public function assignSocialWorker(Request $request)
    {
        $request->validate([
            'social_worker_id' => 'required|exists:users,id',
            'lgu_id' => 'required|exists:lgus,id',
        ]);

        $lgu = Lgu::find($request->lgu_id);
        $lgu->assigned_social_worker_id = $request->social_worker_id;
        $lgu->save();

        return response()->json(['message' => 'Social Worker assigned successfully to LGU'], 200);
    }
    
}
