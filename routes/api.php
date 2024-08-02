<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\BuildingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//* CONNECT REST API ROUTES VOOR GAMEPLAY *//

// Inloggen
Route::post('/authenticate', [UserController::class, 'loginGodot']);
Route::get('/authenticate-token', [AuthController::class, 'authenticateToken'])->middleware('auth:sanctum');

Route::get('/building', [BuildingController::class, 'getBuildingInfo']);
