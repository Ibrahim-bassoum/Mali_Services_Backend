<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Client\CategoryController;
use App\Http\Controllers\Client\ArtisanController;
use App\Http\Controllers\LocationController;


// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/artisans', [App\Http\Controllers\Api\Client\ArtisanController::class, 'index']);
Route::post('/pro/uppdate-status',[UserController::class, 'updateStatus']);
Route::get('/artisans/proches', [App\Http\Controllers\Api\Client\ArtisanController::class, 'obtenirArtisansProches']);

// Routes protégées (nécessitent un Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'succes'=>true,
            'data' => $request->user()
        ]);

    });
    // Ajoute tes autres routes ici plus tard
});

Route::middleware('auth:sanctum')->post('/artisan/location', [App\Http\Controllers\LocationController::class, 'update']);

