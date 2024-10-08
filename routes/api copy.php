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
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\RecordController;
use App\Http\Controllers\Api\ReserveController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ApiController;

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
Route::get('locMain', [MainController::class, 'locMain']);
Route::get('conMain', [MainController::class, 'conMain']);
Route::get('roomMain/{id}', [MainController::class, 'roomMain']);
Route::get('timeMain', [MainController::class, 'timeMain']);
Route::post('addReserve', [MainController::class, 'addReserve']);
Route::get('reserveMain/{id}', [MainController::class, 'reserveMain']);
Route::post('delReserve', [MainController::class, 'delReserve']);
Route::get('holidayMain/{id}/{code}/{next}/{to}', [MainController::class, 'holidayMain']);
Route::resource('member', MemberController::class);
Route::get('checkReserve/{code}/{id}', [ReserveController::class, 'checkReserve']);

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
    Route::resource('location', LocationController::class);
    Route::resource('container', ContainerController::class);
    Route::get('getContainer/{id}', [ContainerController::class, 'getContainer']);
    Route::resource('room', RoomController::class);
    Route::get('conStatus/{id}/{code}', [ContainerController::class, 'conStatus']);
    Route::get('roomStatus/{id}/{code}', [RoomController::class, 'roomStatus']);
    Route::resource('reserve', ReserveController::class);
    Route::post('deleteReserve', [ReserveController::class, 'deleteReserve']);
    Route::resource('record', RecordController::class);
    Route::get('chkRecord/{id}/{code}', [RecordController::class, 'chkRecord']);

    /** Libboard */
    Route::get('getService', [ApiController::class, 'getService']);
    Route::get('getMost', [ApiController::class, 'getMost']);

    /** Pen1 Access Control */
    Route::get('getAccess/{id}', [ApiController::class, 'getAccess']);
}); 
