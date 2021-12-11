<?php

use App\Http\Controllers\Api\{
    LevelController,
    DeveloperController
};
use Illuminate\Support\Facades\Route;

// Route Developers
Route::prefix('developers')->group(function () {
    Route::post('', [DeveloperController::class, 'store']);
    Route::put('/{id}', [DeveloperController::class, 'update']);
    Route::delete('/{id}', [DeveloperController::class, 'destroy']);
    Route::get('/{id}', [DeveloperController::class, 'show']);
    Route::post('/search', [DeveloperController::class, 'search']);
    Route::get('', [DeveloperController::class, 'index']);
});
// Route Levels
Route::prefix('levels')->group(function () {
    Route::post('', [LevelController::class, 'store']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::post('/search', [LevelController::class, 'search']);
    Route::get('', [LevelController::class, 'index']);
});
