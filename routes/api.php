<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OilController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response([
        'message' => 'Api is working'
    ], 200);
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/oil/store', [OilController::class, 'store'])->middleware('auth:sanctum');
Route::get('/oils', [OilController::class, 'index'])->middleware('auth:sanctum');
Route::get('/users', [OilController::class, 'users']);
Route::get('/oil/user/{userId}', [OilController::class, 'getOilReceiptsByUser']);