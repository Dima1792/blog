<?php

use App\Http\Controllers\errorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\weatherController;
use App\Http\Controllers\blogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::any('/test/{currency?}', [testController::class, 'testAction']);
Route::get('/weather/{city?}/{time?}', [weatherController::class, 'getWeather']);
Route::any('/article/{article?}',    [blogController::class, 'web']);
Route::get('/{time?}', [errorController ::class, 'getError']);

