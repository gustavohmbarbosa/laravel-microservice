<?php

use App\Http\Controllers\{
    CategoryController,
    CompanyController
};

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['message' => __('messages.welcome')]));

Route::apiResource('categories', CategoryController::class);

Route::apiResource('companies', CompanyController::class);
