<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products/index', [ProductController::class, 'index']);
Route::get('products/create', [ProductController::class, 'create']);
Route::post('products/store', [ProductController::class, 'store']);
Route::get('product/{product}', [ProductController::class, 'show']);
Route::get('products/{product}/edit', [ProductController::class, 'edit']);
Route::patch('products/{product}/update', [ProductController::class, 'update']);
Route::delete('products/{products}/delete', [ProductController::class, 'destroy']);
