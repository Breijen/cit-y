<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    public function predefinedItems()
    {
        $path = public_path('assets/connect/items.json');
        if (!File::exists($path)) {
            return response()->json(['message' => 'Predefined items not found.'], 404);
        }

        $items = json_decode(File::get($path), true);
        return response()->json($items, 200);
    }

    public function buy(Request $request, $inventoryId)
    {
        $inventory = Inventory::findOrFail($inventoryId);

        $path = public_path('assets/connect/items.json');
        if (!File::exists($path)) {
            return response()->json(['message' => 'Predefined items not found.'], 404);
        }

        $items = json_decode(File::get($path), true);
        $itemData = collect($items)->firstWhere('id', $request->item_id);

        if (!$itemData) {
            return response()->json(['message' => 'Item not found.'], 404);
        }

        // Assume there's some logic here to check user balance and deduct the price

        $item = new Item([
            'item_name' => $itemData['item_name'],
            'item_quantity' => $itemData['item_quantity'],
            'item_model' => $itemData['item_model']
        ]);
        $inventory->items()->save($item);

        return response()->json(['message' => 'Item purchased successfully.', 'item' => $item]);
    }

    public function getInventoryItems($userId)
    {
        $inventory = Inventory::where('user_id', $userId)->first();
        if (!$inventory) {
            return response()->json(['message' => 'Inventory not found.'], 404);
        }

        $items = $inventory->items;
        return response()->json($items);
    }
}
