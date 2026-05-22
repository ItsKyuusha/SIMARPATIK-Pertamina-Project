<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'anggota_jadwal_id',
        'jam_masuk',
        'jam_keluar',
        'status',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'jam_masuk' => 'datetime',
            'jam_keluar' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function anggotaJadwal()
    {
        return $this->belongsTo(AnggotaJadwal::class);
    }
}