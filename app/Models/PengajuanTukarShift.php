<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanTukarShift extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_tukar_shift';

    protected $fillable = [
        'anggota_pengaju_id',
        'anggota_tujuan_id',
        'tipe_pengajuan',
        'alasan',
        'status',
        'disetujui_oleh',
        'disetujui_pada',
    ];

    protected function casts(): array
    {
        return [
            'disetujui_pada' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function pengaju()
    {
        return $this->belongsTo(
            AnggotaJadwal::class,
            'anggota_pengaju_id'
        );
    }

    public function tujuan()
    {
        return $this->belongsTo(
            AnggotaJadwal::class,
            'anggota_tujuan_id'
        );
    }

    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'disetujui_oleh'
        );
    }

    public function approval()
    {
        return $this->hasMany(ApprovalPengajuan::class, 'pengajuan_id');
    }
}