<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Use App\Http\Controllers\Management\ContractController;
Use App\Http\Controllers\Management\DashboardController;
Use App\Http\Controllers\Management\EmployeeController;
Use App\Http\Controllers\Management\ScheduleController;
Use App\Http\Controllers\Management\ShiftController;
Use App\Http\Controllers\Management\ShiftHistoryController;
Use App\Http\Controllers\Management\ShiftSwapController;


Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

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

Route::prefix('management')->middleware(['auth', 'role:management'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('employees', EmployeeController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('schedules', ScheduleController::class);

    Route::get('/swaps', [ShiftSwapController::class, 'index']);
    Route::post('/swaps/{id}/approve', [ShiftSwapController::class, 'approve']);
    Route::post('/swaps/{id}/reject', [ShiftSwapController::class, 'reject']);

    Route::get('/histories', [ShiftHistoryController::class, 'index']);
});