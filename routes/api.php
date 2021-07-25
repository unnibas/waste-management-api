<?php

use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Area\AreaSubAreaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientAreaController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientUserController;
use App\Http\Controllers\CollectionPoint\CollectionPointController;
use App\Http\Controllers\SubArea\SubAreaCollectionPointController;
use App\Http\Controllers\SubArea\SubAreaController;
use App\Http\Controllers\User\UserController;
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


Route::post('/login',[AuthController::class,'getToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/revoke',[AuthController::class, 'revokeToken']);

    Route::get('test', function (){
        $user = auth()->user();
        print_r($user->name);
    });
});

/**
 * User
 */
Route::apiResource('users', UserController::class)->except(['create','edit']);

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

/**
 * Collection point
 */
Route::apiResource('cpoints', CollectionPointController::class)->only(['show', 'update', 'destroy']);

/**
 * Collection
 */

/**
 * Collection Request
 */







