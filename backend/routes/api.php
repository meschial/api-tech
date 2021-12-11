<?php

use App\Http\Controllers\Api\{
    LevelController,
    DeveloperController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route Developers
Route::put('developers/{id}', [DeveloperController::class, 'update']);
Route::delete('developers/{id}', [DeveloperController::class, 'destroy']);
Route::get('developers/{id}', [DeveloperController::class, 'show']);
Route::post('/developers/search', [DeveloperController::class, 'search']);
Route::post('developers', [DeveloperController::class, 'store']);
Route::get('developers', [DeveloperController::class, 'index']);

// Route Levels
Route::post('levels', [LevelController::class, 'store']);
Route::put('levels/{id}', [LevelController::class, 'update']);
Route::delete('levels/{id}', [LevelController::class, 'destroy']);
Route::get('levels/{id}', [LevelController::class, 'show']);
Route::post('/levels/search', [LevelController::class, 'search']);
Route::get('levels', [LevelController::class, 'index']);
