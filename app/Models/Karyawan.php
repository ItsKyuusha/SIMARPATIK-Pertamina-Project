<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'user_id',
        'kontrak_id',
        'kode_karyawan',
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'no_telp',
        'alamat',
        'jabatan',
        'tanggal_masuk',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_masuk' => 'date',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }

    public function anggotaJadwal()
    {
        return $this->hasMany(AnggotaJadwal::class);
    }

    public function riwayatShift()
    {
        return $this->hasMany(RiwayatShift::class);
    }
}