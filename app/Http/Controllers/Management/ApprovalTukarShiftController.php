<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ApprovalPengajuan;
use App\Models\PengajuanTukarShift;
use App\Models\RiwayatShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalTukarShiftController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanTukarShift::with([
            'pengaju.karyawan',
            'tujuan.karyawan'
        ])
        ->where('tipe_pengajuan', 'tukar_leader')
        ->latest()
        ->paginate(10);

        return view('management.approval-shift.index', compact('pengajuan'));
    }

    public function approve(PengajuanTukarShift $pengajuan)
    {
        // cegah approve ulang
        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses');
        }

        DB::transaction(function () use ($pengajuan) {

            /*
            |--------------------------------------------------------------------------
            | Ambil data anggota jadwal
            |--------------------------------------------------------------------------
            */

            $anggotaPengaju = $pengajuan->pengaju;
            $anggotaTujuan  = $pengajuan->tujuan;

            /*
            |--------------------------------------------------------------------------
            | Simpan sementara karyawan
            |--------------------------------------------------------------------------
            */

            $karyawanPengaju = $anggotaPengaju->karyawan_id;
            $karyawanTujuan  = $anggotaTujuan->karyawan_id;

            /*
            |--------------------------------------------------------------------------
            | Tukar jadwal leader
            |--------------------------------------------------------------------------
            */

            $anggotaPengaju->update([
                'karyawan_id' => $karyawanTujuan
            ]);

            $anggotaTujuan->update([
                'karyawan_id' => $karyawanPengaju
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update status pengajuan
            |--------------------------------------------------------------------------
            */

            $pengajuan->update([
                'status' => 'disetujui',
                'disetujui_oleh' => Auth::id(),
                'disetujui_pada' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Simpan approval history
            |--------------------------------------------------------------------------
            */

            ApprovalPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'approver_id' => Auth::id(),
                'status_approval' => 'disetujui',
                'approved_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | SIMPAN RIWAYAT SHIFT (WAJIB TAMBAHAN BARU)
            |--------------------------------------------------------------------------
            */

            // Riwayat untuk pengaju
            RiwayatShift::create([
                'karyawan_id' => $karyawanPengaju,
                'jadwal_lama_id' => $anggotaPengaju->jadwal_id,
                'jadwal_baru_id' => $anggotaTujuan->jadwal_id,
                'diubah_oleh' => Auth::id(),
                'tipe_perubahan' => 'tukar',
                'catatan' => 'Tukar shift leader (pengaju)',
            ]);

            // Riwayat untuk tujuan
            RiwayatShift::create([
                'karyawan_id' => $karyawanTujuan,
                'jadwal_lama_id' => $anggotaTujuan->jadwal_id,
                'jadwal_baru_id' => $anggotaPengaju->jadwal_id,
                'diubah_oleh' => Auth::id(),
                'tipe_perubahan' => 'tukar',
                'catatan' => 'Tukar shift leader (tujuan)',
            ]);
        });

        return back()->with(
            'success',
            'Pengajuan berhasil disetujui dan jadwal leader telah ditukar'
        );
    }

    public function reject(Request $request, PengajuanTukarShift $pengajuan)
    {
        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses');
        }

        DB::transaction(function () use ($request, $pengajuan) {

            $pengajuan->update([
                'status' => 'ditolak',
                'disetujui_oleh' => Auth::id(),
                'disetujui_pada' => now(),
            ]);

            ApprovalPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'approver_id' => Auth::id(),
                'status_approval' => 'ditolak',
                'catatan' => $request->catatan,
                'approved_at' => now(),
            ]);
        });

        return back()->with('success', 'Pengajuan berhasil ditolak');
    }
}