<?php

// app/Http/Controllers/API/LguAssistanceRequestController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\AssistanceRequest;
use App\Models\AssistanceRequestItem;

class LguAssistanceRequestController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'items' => 'required|array', // Ensure 'items' is an array
            'items.*.item_name' => 'required|string|max:255', // Validate each item name
            'items.*.quantity' => 'required|integer|min:1', // Validate each quantity
            'dromic_report' => 'required|file|mimes:pdf|max:2048', // File must be PDF
            'letter_of_request' => 'required|file|mimes:pdf|max:2048', // File must be PDF
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Store the uploaded files
        $dromicPath = $request->file('dromic_report')->store('dromic_reports', 'public');
        $letterPath = $request->file('letter_of_request')->store('letters_of_request', 'public');

        // Create the assistance request
        $assistanceRequest = AssistanceRequest::create([
            'user_id' => $request->user()->id, // Authenticated LGU user
            'dromic_report_path' => $dromicPath,
            'letter_of_request_path' => $letterPath,
        ]);

        // Loop through each item and create an AssistanceRequestItem
        foreach ($request->items as $item) {
            AssistanceRequestItem::create([
                'assistance_request_id' => $assistanceRequest->id,
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Return success response
        return response()->json([
            'message' => 'Assistance request submitted successfully',
            'assistance_request' => $assistanceRequest->load('items'), // Load the items with the request
        ], 201);
    }
}

