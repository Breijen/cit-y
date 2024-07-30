<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{

    public function createInventory($userId)
    {
        $user = User::findOrFail($userId);

        // Check if the user already has an inventory
        $existingInventory = Inventory::where('user_id', $userId)->first();
        if ($existingInventory) {
            Log::info("User ID $userId already has an inventory.");
            return response()->json(['message' => 'Inventory already exists for this user.'], 400);
        }

        // Create a new inventory for the user
        $inventory = new Inventory();
        $inventory->user_id = $user->id;
        $inventory->save();

        Log::info("Inventory created successfully for User ID $userId.");
        return response()->json(['message' => 'Inventory created successfully.']);
    }
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        error_log('Some message here.');
        return view('inventory.show', ['inventory' => $user->inventory]);
    }
}
