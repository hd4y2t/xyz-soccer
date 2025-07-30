<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TournamentController;
use App\Http\Controllers\Api\TournamentResultController;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Teams
    Route::apiResource('teams', TeamController::class);

    //Players
    Route::group(['prefix' => 'teams/{team}/players'], function () {
        Route::get('/', [PlayerController::class, 'index']);
        Route::post('/', [PlayerController::class, 'store']);
        Route::put('/{player}', [PlayerController::class, 'update']);
        Route::delete('/{player}', [PlayerController::class, 'destroy']);
    });

    // Tournaments
    Route::apiResource('tournaments', TournamentController::class);
    // Goal
    Route::post('tournaments/{tournament}/result', TournamentResultController::class);
    // Reports
    Route::get('tournaments/{tournament}/report', ReportController::class);
});
