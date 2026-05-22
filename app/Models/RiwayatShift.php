<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatShift extends Model
{
    use HasFactory;

    protected $table = 'riwayat_shift';

    public $timestamps = false;

    protected $fillable = [
        'karyawan_id',
        'jadwal_lama_id',
        'jadwal_baru_id',
        'diubah_oleh',
        'tipe_perubahan',
        'catatan',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function jadwalLama()
    {
        return $this->belongsTo(
            Jadwal::class,
            'jadwal_lama_id'
        );
    }

    public function jadwalBaru()
    {
        return $this->belongsTo(
            Jadwal::class,
            'jadwal_baru_id'
        );
    }

    public function pengubah()
    {
        return $this->belongsTo(
            User::class,
            'diubah_oleh'
        );
    }
}