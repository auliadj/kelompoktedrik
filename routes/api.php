<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::middleware('api')->group(function () {
  Route::get('users', [UserController::class, 'index']);
  Route::post('users', [UserController::class,'store'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
  Route::delete('users/{id}', [UserController::class,'destroy'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
  Route::put('users/{id}', [UserController::class, 'update'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});

Route::middleware('api')->group(function () {
  Route::get('product', [ProductController::class, 'index']);
  Route::post('product', [ProductController::class, 'store'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
  Route::delete('product/{id}', [ProductController::class, 'destroy'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
  Route::put('product/{id}', [ProductController::class, 'update'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});

Route::middleware('api')->group(function () {
  Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::put('categories/{id}', [CategoryController::class, 'update'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});