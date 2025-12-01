<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User document requests (already available via resource if needed)
    Route::resource('document-requests', App\Http\Controllers\DocumentRequestController::class)->only(['index','create','store','show']);

    // Admin: view all document requests
    Route::get('admin/document-requests', [App\Http\Controllers\Admin\DocumentRequestController::class, 'index'])
        ->name('admin.document-requests.index');
});

require __DIR__.'/auth.php';
