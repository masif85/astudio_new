<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeSheetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:api')->group(function(){

    Route::get('logout', [AuthController::class, 'logout']);

    Route::resource('project', ProjectController::class);

    Route::resource('timesheet', TimeSheetController::class);

    Route::resource('attribute', AttributeController::class);

    Route::resource('attribute_value', AttributeValueController::class);

    Route::get('projects', [GeneralController::class, 'search']);

});
