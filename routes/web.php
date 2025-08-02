<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UserName;
use App\Http\Controllers\InputController;

Route::get('/input', function () {
    return view('input');
});

Route::post('/input', [InputController::class, 'store']);

Route::get('/search', function () {
    return view('search');
});

Route::get('/search-user/id/{id}', [InputController::class, 'showById']);

Route::get('/search-user/address/{address}', [InputController::class, 'showByAddress']);

Route::get('/dashboard', function () {
    return view('dashboard');
});
