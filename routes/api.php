<?php

use App\Http\Controllers\API\{TaskController, AuthController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/tasks', TaskController::class);
Route::post('/login', [AuthController::class, 'login']);
