<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::as('api.')->group(function (): void {
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::apiResource('/projects', ProjectController::class)->except(['update', 'destroy']);
        Route::apiResource('/issues', IssueController::class)->except(['destroy']);
        Route::apiResource('/reports', ReportController::class)->only(['index']);
    });
});
