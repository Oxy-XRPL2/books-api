<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;


Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('categories', CategoryController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
