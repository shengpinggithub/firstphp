<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UserName;
use App\Http\Controllers\GreetController;

Route::get('/greet', function () {
    return view('greet');
});

Route::post('/greet', [GreetController::class, 'store']);

Route::get('/search', function () {
    return view('search');
});

Route::get('/search-user/id/{id}', [GreetController::class, 'showById']);

Route::get('/search-user/address/{address}', [GreetController::class, 'showByAddress']);

Route::get('/dashboard', function () {
    return view('dashboard');
});
