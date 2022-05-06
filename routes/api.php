<?php

use App\Http\Controllers\{
    CategoryController,
};

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['message' => 'Microservice with Laravel']));

Route::apiResource('categories', CategoryController::class);
