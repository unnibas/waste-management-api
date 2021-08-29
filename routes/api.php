<?php

use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Area\AreaSubAreaController;
use App\Http\Controllers\Auth\TokenController;
use App\Http\Controllers\Client\ClientAreaController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientUserController;
use App\Http\Controllers\CollectionPoint\CollectionPointController;
use App\Http\Controllers\CollectionPoint\CollectionPointDailyCollectionController;
use App\Http\Controllers\DailyCollection\DailyCollectionController;
use App\Http\Controllers\Device\DeviceController;
use App\Http\Controllers\SubArea\SubAreaCollectionPointController;
use App\Http\Controllers\SubArea\SubAreaController;
use App\Http\Controllers\SubArea\SubAreaDutyController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserDailyCollectionController;
use App\Http\Controllers\User\UserDutyController;
use Illuminate\Support\Facades\Route;


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
Route::get('/test', function () {
        print_r('test');
});

Route::post('/login',[TokenController::class,'getToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/revoke',[TokenController::class, 'revokeToken']);
});

/**
 * User
 */
Route::apiResource('users', UserController::class)->except(['create','edit']);
Route::apiResource('users.duties', UserDutyController::class)->only(['index','store']);
Route::apiResource('users.collections', UserDailyCollectionController::class)->only(['index']);

/**
 * Client
 */
Route::apiResource('clients', ClientController::class)->except(['create' ,'edit']);
Route::apiResource('clients.users', ClientUserController::class)->only(['index', 'store']);
Route::apiResource('clients.areas', ClientAreaController::class)->only(['index', 'store']);

/**
 * Area
 */
Route::apiResource('areas', AreaController::class)->only(['show', 'update', 'destroy']);
Route::apiResource('areas.subareas', AreaSubAreaController::class)->only(['index', 'store']);

/**
 * Sub Area
 */
Route::apiResource('subareas', SubAreaController::class)->only(['show', 'update', 'destroy']);
Route::apiResource('subareas.cpoints', SubAreaCollectionPointController::class)->only(['index', 'store']);
Route::apiResource('subareas.duties', SubAreaDutyController::class)->only(['index', 'store']);

/**
 * Collection point
 */
Route::apiResource('cpoints', CollectionPointController::class)->only(['show', 'update', 'destroy']);
Route::apiResource('cpoints.collections', CollectionPointDailyCollectionController::class)->only(['index']);

/**
 * Daily Collection
 */
Route::apiResource('collections', DailyCollectionController::class)->only(['store', 'show']);

/**
 * Collection Request
 */


 /**
  * Device
  */
  Route::apiResource('devices', DeviceController::class)->except(['create' ,'edit']);








