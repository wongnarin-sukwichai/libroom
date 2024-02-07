<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MonthController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\TimeController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\ContainerController;
use App\Http\Controllers\Api\RoomController;

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
Route::post('logout', [AuthController::class, 'logout']);
Route::resource('location', LocationController::class);

Route::middleware('guest')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', UserController::class);
    Route::resource('month', MonthController::class);
    Route::resource('holiday', HolidayController::class);
    Route::resource('time', TimeController::class);
    Route::resource('upload', UploadController::class);
    Route::post('uploadPicContainer', [UploadController::class, 'uploadPicContainer']);
    Route::post('uploadPicRoom', [UploadController::class, 'uploadPicRoom']);
    Route::resource('container', ContainerController::class);
    Route::resource('room', RoomController::class);
    Route::get('conStatus/{id}/{code}', [ContainerController::class, 'conStatus']);
    Route::get('roomStatus/{id}/{code}', [RoomController::class, 'roomStatus']);
});
