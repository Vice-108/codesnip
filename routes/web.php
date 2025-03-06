<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SnippetController;

// Public routes - accessible to everyone
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('snippets', [SnippetController::class, 'index'])->name('snippets');

// Protected routes - require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Snippet management routes - specific routes first
    Route::get('snippets/create', [SnippetController::class, 'create'])->name('snippets.create');
    Route::post('snippets', [SnippetController::class, 'store'])->name('snippets.store');
});

// Public snippet routes
Route::get('snippets/{snippet}', [SnippetController::class, 'show'])->name('snippets.show');

// Protected snippet routes that require the snippet parameter
Route::middleware(['auth'])->group(function () {
    Route::get('snippets/{snippet}/edit', [SnippetController::class, 'edit'])->name('snippets.edit');
    Route::put('snippets/{snippet}', [SnippetController::class, 'update'])->name('snippets.update');
    Route::delete('snippets/{snippet}', [SnippetController::class, 'destroy'])->name('snippets.destroy');
    Route::post('snippets/{snippet}/favorite', [SnippetController::class, 'toggleFavorite'])->name('snippets.favorite');
    Route::get('/my-snippets', [SnippetController::class, 'mySnippets'])->name('snippets.my');
});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
