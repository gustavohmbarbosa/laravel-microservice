<?php

use App\Http\Controllers\{
    CategoryController,
    CompanyController
};

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['message' => 'Microservice with Laravel']));

Route::apiResource('categories', CategoryController::class);

Route::apiResource('companies', CompanyController::class);
