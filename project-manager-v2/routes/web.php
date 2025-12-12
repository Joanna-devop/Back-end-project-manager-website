<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Create/Store routes
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    // THESE ARE THE ONLY THREE LINES ALLOWED FOR EDIT, UPDATE, DELETE!
    Route::get('/projects/{project:pid}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::patch('/projects/{project:pid}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project:pid}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});


require __DIR__.'/auth.php';
