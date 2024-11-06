<?php

use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('book-listing');
    Route::post('/books', [BookController::class, 'store'])->name('book-store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('book-show');
    Route::patch('/books/{id}/borrow', [BookController::class, 'borrowBook'])->name('book-borrow');
    Route::patch('/books/{id}/return', [BookController::class, 'returnBook'])->name('book-return');

    Route::apiResource('clients', ClientController::class)->except(['update', 'edit', 'create']);
});
