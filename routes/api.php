<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1.0')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [BooksController::class, 'getAll']);
        Route::get('/{id}', [BooksController::class, 'getById']);
        Route::post('/', [BooksController::class, 'create']);
        Route::put('/{id}', [BooksController::class, 'edit']);
        Route::delete('/{id}', [BooksController::class, 'delete']);
    });
});
