<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssistanceRequestItem;
use App\Models\DeliveryUserAssignment;
use App\Models\AssistanceRequest;

class DeliveryController extends Controller
{
    // Get items assigned to the delivery user
    public function getAssignedItems(Request $request)
    {
        $user = $request->user();

        // Get the items assigned to the delivery user
        $items = AssistanceRequestItem::whereHas('deliveryAssignment', function ($query) use ($user) {
            $query->where('delivery_user_id', $user->id);
        })->with('request')->get();

        return response()->json([
            'message' => 'Assigned items retrieved successfully',
            'items' => $items,
        ]);
    }

    // Assign item to a delivery user
    public function assignToDeliveryUser(Request $request, $itemId)
    {
        $request->validate([
            'delivery_user_id' => 'required|exists:users,id',  // Ensure delivery user exists
        ]);

        // Check if the item exists
        $item = AssistanceRequestItem::findOrFail($itemId);

        // Assign the item to the delivery user
        DeliveryUserAssignment::create([
            'delivery_user_id' => $request->delivery_user_id,
            'assistance_request_item_id' => $item->id,
        ]);

        return response()->json(['message' => 'Item assigned to delivery user successfully']);
    }

    // Update the delivery status of an item
    public function updateStatus(Request $request, $itemId)
    {
        $request->validate([
            'status' => 'required|in:pending,delivered',
            'delivery_date' => 'required_if:status,delivered|date',
        ]);
    
        // Find the item by ID
        $item = AssistanceRequestItem::findOrFail($itemId);
    
        // Ensure the item is assigned to the delivery user making the request
        if (!$item->deliveryAssignment || $item->deliveryAssignment->delivery_user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized: This item is not assigned to you'], 403);
        }
    
        // Check if the item has already been delivered
        if ($item->status == 'delivered') {
            return response()->json(['message' => 'Item has already been delivered'], 400);
        }
    
        // Update the item's status and delivery date if provided
        $item->status = $request->status;
        if ($request->status == 'delivered') {
            $item->delivery_date = $request->delivery_date;
        }
        $item->save();
    
        return response()->json(['message' => 'Item status updated successfully']);
    }
}
