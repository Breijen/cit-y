<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Building;

class BuildingController extends Controller
{
    public function getBuildingInfo(Request $request)
    {
        // Validate the query parameter
        $request->validate([
            'id' => 'required|string',
        ]);

        // Fetch the building details from the database
        $building = Building::find($request->id);

        if (!$building) {
            return response()->json(['error' => 'Building not found'], 404);
        }

        // Return the building details as a JSON response
        return response()->json($building);
    }
}
