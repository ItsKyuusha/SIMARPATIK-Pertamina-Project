<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Use App\Http\Controllers\Management\DashboardController as ManagementDashboard;
Use App\Http\Controllers\Management\KaryawanController;
Use App\Http\Controllers\Management\KontrakController;
Use App\Http\Controllers\Management\ShiftController;
Use App\Http\Controllers\Management\JadwalController;
Use App\Http\Controllers\Management\MonitoringKehadiranController;
Use App\Http\Controllers\Management\RiwayatShiftController;
Use App\Http\Controllers\Management\ApprovalTukarShiftController;
Use App\Http\Controllers\Leader\DashboardController as LeaderDashboard;
use App\Http\Controllers\Leader\AbsensiController as LeaderAbsensiController;
use App\Http\Controllers\Leader\MonitoringOperatorController;
use App\Http\Controllers\Leader\TukarShiftLeaderController;
use App\Http\Controllers\Leader\ApprovalOperatorController;
Use App\Http\Controllers\Operator\DashboardController as OperatorDashboard;
use App\Http\Controllers\Operator\JadwalSayaController;
use App\Http\Controllers\Operator\AbsensiController as OperatorAbsensiController;
use App\Http\Controllers\Operator\TukarShiftController;

Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::prefix('management')
    ->name('management.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [ManagementDashboard::class, 'index']);

        Route::resource('karyawan', KaryawanController::class);
        Route::resource('kontrak', KontrakController::class);
        Route::resource('shift', ShiftController::class);
        Route::resource('jadwal', JadwalController::class);

        Route::get(
            'monitoring-kehadiran',
            [MonitoringKehadiranController::class, 'index']
        )->name('monitoring-kehadiran.index');

        Route::get(
            'riwayat-shift',
            [RiwayatShiftController::class, 'index']
        )->name('riwayat-shift.index');

        Route::get(
            'approval-shift',
            [ApprovalTukarShiftController::class, 'index']
        )->name('approval-shift.index');

        Route::post(
            'approval-shift/{pengajuan}/approve',
            [ApprovalTukarShiftController::class, 'approve']
        )->name('approval-shift.approve');

        Route::post(
            'approval-shift/{pengajuan}/reject',
            [ApprovalTukarShiftController::class, 'reject']
        )->name('approval-shift.reject');
    });

Route::prefix('leader')
    ->name('leader.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [LeaderDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/absensi', [LeaderAbsensiController::class, 'index'])
            ->name('absensi.index');

        Route::post('/absensi', [LeaderAbsensiController::class, 'store'])
            ->name('absensi.store');

        Route::post('/absensi/{absensi}/checkout', [LeaderAbsensiController::class, 'checkout'])
            ->name('absensi.checkout');

        Route::get(
            '/monitoring-operator',
            [MonitoringOperatorController::class, 'index']
        )->name('monitoring-operator.index');

        Route::get(
            '/tukar-shift',
            [TukarShiftLeaderController::class, 'index']
        )->name('tukar-shift.index');

        Route::get(
            '/tukar-shift/create',
            [TukarShiftLeaderController::class, 'create']
        )->name('tukar-shift.create');

        Route::post(
            '/tukar-shift',
            [TukarShiftLeaderController::class, 'store']
        )->name('tukar-shift.store');

        Route::get(
            '/approval-operator',
            [ApprovalOperatorController::class, 'index']
        )->name('approval-operator.index');

        Route::post(
            '/approval-operator/{pengajuan}/approve',
            [ApprovalOperatorController::class, 'approve']
        )->name('approval-operator.approve');

        Route::post(
            '/approval-operator/{pengajuan}/reject',
            [ApprovalOperatorController::class, 'reject']
        )->name('approval-operator.reject');
    });

Route::prefix('operator')
    ->name('operator.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [OperatorDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/jadwal-saya', [JadwalSayaController::class, 'index'])
            ->name('jadwal-saya.index');

        Route::get('/absensi', [OperatorAbsensiController::class, 'index'])
            ->name('absensi.index');

        Route::post('/absensi', [OperatorAbsensiController::class, 'store'])
            ->name('absensi.store');

        Route::post('/absensi/{absensi}/checkout', [OperatorAbsensiController::class, 'checkout'])
            ->name('absensi.checkout');

        Route::get('/tukar-shift', [TukarShiftController::class, 'index'])
            ->name('tukar-shift.index');

        Route::get('/tukar-shift/create', [TukarShiftController::class, 'create'])
            ->name('tukar-shift.create');

        Route::post('/tukar-shift', [TukarShiftController::class, 'store'])
            ->name('tukar-shift.store');
    });