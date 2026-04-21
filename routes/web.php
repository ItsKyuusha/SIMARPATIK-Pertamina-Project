<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Use App\Http\Controllers\Management\ContractController;
Use App\Http\Controllers\Management\DashboardController as ManagementDashboard;
Use App\Http\Controllers\Management\EmployeeController;
Use App\Http\Controllers\Management\ScheduleController as ManagementSchedule;
Use App\Http\Controllers\Management\ShiftController;
Use App\Http\Controllers\Management\ShiftHistoryController;
Use App\Http\Controllers\Management\ShiftSwapController as ManagementShift;
use App\Http\Controllers\Leader\DashboardController as LeaderDashboard;
use App\Http\Controllers\Leader\TeamController;
use App\Http\Controllers\Leader\ShiftSwapController as LeaderShift;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboard;
use App\Http\Controllers\Operator\ScheduleController as OperatorSchedule;
use App\Http\Controllers\Operator\ShiftSwapController as OperatorShift;
use App\Http\Controllers\Operator\HistoryController;


Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::prefix('management')->middleware(['auth', 'role:management'])->group(function () {

    Route::get('/dashboard', [ManagementDashboard::class, 'index']);

    Route::resource('employees', EmployeeController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('schedules', ManagementSchedule::class);

    Route::get('/swaps', [ManagementShift::class, 'index']);
    Route::post('/swaps/{id}/approve', [ManagementShift::class, 'approve']);
    Route::post('/swaps/{id}/reject', [ManagementShift::class, 'reject']);

    Route::get('/histories', [ShiftHistoryController::class, 'index']);
});

Route::prefix('leader')->middleware(['auth', 'role:leader'])->group(function () {

    Route::get('/dashboard', [LeaderDashboard::class, 'index']);

    Route::get('/team', [TeamController::class, 'index']);

    Route::get('/swaps', [LeaderShift::class, 'index']);
    Route::post('/swaps/{id}/approve', [LeaderShift::class, 'approve']);
    Route::post('/swaps/{id}/reject', [LeaderShift::class, 'reject']);

    Route::get('/swap/create', [LeaderShift::class, 'createLeaderSwap']);
    Route::post('/swap/store', [LeaderShift::class, 'storeLeaderSwap']);

});

Route::prefix('operator')->middleware(['auth', 'role:operator'])->group(function () {

    Route::get('/dashboard', [OperatorDashboard::class, 'index']);

    Route::get('/schedule', [OperatorSchedule::class, 'index']);

    Route::get('/swap', [OperatorShift::class, 'index'])->name('operator.swap.index');
    Route::get('/swap/create', [OperatorShift::class, 'create']);
    Route::post('/swap/store', [OperatorShift::class, 'store']);

    Route::get('/history', [HistoryController::class, 'index']);

});