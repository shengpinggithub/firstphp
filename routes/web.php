<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\InputController;

// Input form routes
Route::get('/input', fn () => view('input'));
Route::post('/input', [InputController::class, 'store'])->name('input.store');

// Search UI
Route::get('/search', fn () => view('search'));

// Search user by ID and email

Route::get('/search-user/id/{id}', [InputController::class, 'show'])->name('user.search.id');

Route::get('/search-user/email/{email}', [InputController::class, 'showByEmail'])->name('user.search.email');

// Dashboard view
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

// RESTful user routes
Route::get('/user/{id}', [InputController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [InputController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [InputController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [InputController::class, 'destroy'])->name('user.destroy');
