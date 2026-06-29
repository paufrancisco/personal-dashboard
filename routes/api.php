<?php

use App\Http\Controllers\ShortcutsController;
use App\Http\Controllers\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('shortcuts', ShortcutsController::class);
    Route::apiResource('notes', NotesController::class);
});

