<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeightLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightTargetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/step1', [RegisterController::class, 'showStep1']);
Route::post('/register/step1', [RegisterController::class, 'storeStep1']);

Route::get('/register/step2', [RegisterController::class, 'showStep2']);
Route::post('/register/step2', [RegisterController::class, 'storeStep2']);

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index']);
    Route::get('/weight_logs/create', [WeightLogController::class, 'create']);
    Route::post('/weight_logs', [WeightLogController::class, 'store']);

    Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'edit']);
    Route::put('/weight_logs/goal_setting', [WeightTargetController::class, 'update']);

    Route::get('/weight_logs/search', [WeightLogController::class, 'search']);

    Route::get('/weight_logs/{weightLog}', [WeightLogController::class, 'show']);
    Route::put('/weight_logs/{weightLog}', [WeightLogController::class, 'update']);
    Route::delete('/weight_logs/{weightLog}', [WeightLogController::class, 'destroy']);
});
