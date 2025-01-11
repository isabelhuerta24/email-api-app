<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SenatorEmailController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/send-email', [SenatorEmailController::class, 'sendEmail']);

//Protect the endpoint from brute force or spam attacks by applying rate limiting. Limits requests to 10 per minute
Route::middleware('throttle:10,1')->post('/send-email', [SenatorEmailController::class, 'sendEmail']);
