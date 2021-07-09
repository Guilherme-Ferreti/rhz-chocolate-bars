<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocoaBatchController;
use App\Http\Controllers\ChocolateBarController;
use App\Http\Controllers\ConsultationController;

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

Route::group(['middleware' => 'auth.basic.token'], function () {
    Route::apiResource('cocoa-batches', CocoaBatchController::class);
    Route::apiResource('chocolate-bars', ChocolateBarController::class);
});

Route::get('/consultation/chocolate-bars/{code}', [ConsultationController::class, 'chocolate_bar']);