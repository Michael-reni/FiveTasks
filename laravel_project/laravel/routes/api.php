<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::post('/decryptMessage', [TaskController::class, 'decryptMessage']);
Route::post('/encryptMessage', [TaskController::class, 'encryptMessage']);

Route::post('/lcdDisplay', [TaskController::class, 'lcdDisplay']);

Route::get('/lotteryWinners', [TaskController::class, 'lotteryWinners']);
Route::get('/incomeStatistic', [TaskController::class, 'incomeStatistic']);




