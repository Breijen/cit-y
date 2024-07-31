<?php

use App\Http\Controllers\BuildingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//* CONNECT REST API ROUTES VOOR GAMEPLAY *//

// Inloggen
Route::post('/authenticate', [UserController::class, 'loginGodot']);

Route::get('/building', [BuildingController::class, 'getBuildingInfo']);
