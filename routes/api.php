<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimesheetController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(["middleware" => ["auth:api"]],function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('projects/filter', [ProjectController::class, 'filter']);

    Route::apiResource('projects', ProjectController::class);

    Route::apiResource('attributes', AttributeController::class);

    Route::apiResource('timesheets', TimesheetController::class);

});