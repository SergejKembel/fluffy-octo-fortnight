<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VisitorController;
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


Route::apiResource('events', EventController::class)->except(['destroy', 'update']);
Route::apiResource('cities', CityController::class)->except(['destroy', 'update']);
Route::apiResource('visitors', VisitorController::class)->except(['destroy', 'update']);
Route::apiResource('tickets', TicketController::class)->except(['destroy', 'update']);
