<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggotaJadwal extends Model
{
    use HasFactory;

    protected $table = 'anggota_jadwal';

    protected $fillable = [
        'jadwal_id',
        'karyawan_id',
        'tipe_role',
        'status_kehadiran',
        'catatan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class);
    }

    public function pengajuanSebagaiPengaju()
    {
        return $this->hasMany(
            PengajuanTukarShift::class,
            'anggota_pengaju_id'
        );
    }

    public function pengajuanSebagaiTujuan()
    {
        return $this->hasMany(
            PengajuanTukarShift::class,
            'anggota_tujuan_id'
        );
    }
}