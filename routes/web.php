<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:management'])->group(function () {
    Route::get('/management', function () {
        return "Dashboard Management";
    });
});

Route::middleware(['auth', 'role:leader'])->group(function () {
    Route::get('/leader', function () {
        return "Dashboard Leader";
    });
});

Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator', function () {
        return "Dashboard Operator";
    });
});

Route::middleware(['auth', 'role:management'])->group(function () {
    Route::get('/management', function () {
        return view('management.dashboard');
    });
});

Route::middleware(['auth', 'role:leader'])->group(function () {
    Route::get('/leader', function () {
        return view('leader.dashboard');
    });
});

Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator', function () {
        return view('operator.dashboard');
    });
});