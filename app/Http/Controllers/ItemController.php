<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Item;

class ItemController extends Controller
{
    public function create($inventoryId)
    {
        return view('item.create', ['inventoryId' => $inventoryId]);
    }

    public function store(Request $request, $inventoryId)
    {
        $inventory = Inventory::findOrFail($inventoryId);
        $inventory->items()->create($request->all());
        return redirect()->route('inventory.show', ['userId' => $inventory->user_id]);
    }

    public function update(Request $request, $inventoryId, $itemId)
    {
        $item = Item::where('inventory_id', $inventoryId)->findOrFail($itemId);
        $item->update($request->all());
        return redirect()->route('inventory.show', ['userId' => $item->inventory->user_id]);
    }

    public function destroy($inventoryId, $itemId)
    {
        $item = Item::where('inventory_id', $inventoryId)->findOrFail($itemId);
        $item->delete();
        return redirect()->route('inventory.show', ['userId' => $item->inventory->user_id]);
    }
}
