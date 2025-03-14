<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProjectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('attributes', AttributeController::class);

Route::get('projects/filter', [ProjectController::class, 'filter']);

Route::apiResource('projects', ProjectController::class);