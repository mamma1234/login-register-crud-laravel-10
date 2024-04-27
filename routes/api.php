<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DispatchController;
use Illuminate\Support\Facades\Log;
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

Route::get('/orders', [OrderController::class, 'orders']);
Route::get('/dispatches', [DispatchController::class, 'dispatches']);
Route::post('/twentyFour.dispatch', [DispatchController::class, 'twentyFour']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

