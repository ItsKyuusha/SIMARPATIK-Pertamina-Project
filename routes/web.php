<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
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
