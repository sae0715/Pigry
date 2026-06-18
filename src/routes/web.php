<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/weight_logs', function () {
    return view('/weight_logs.index');
});
