<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
});



Route::apiResource('products', ProductController::class);

Route::middleware(['guest:sanctum'])->group(function () {
    Route::post('/generate-api-token', [AccessTokensController::class, 'store']);
});
Route::delete('/generate-api-token/{token?}', [AccessTokensController::class, 'destroy'])->middleware('auth:sanctum');
