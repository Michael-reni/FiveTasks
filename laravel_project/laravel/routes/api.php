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

Route::get('/task1/{year}/{month}',[TaskController::class,'task_1_calendar']);


Route::get('/task2/{excell_string}',[TaskController::class,'task2']);

Route::post('/task3/user',[TaskController::class,'task3_user']);
Route::post('/task3/company',[TaskController::class,'task3_company']);


