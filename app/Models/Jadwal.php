<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'shift_id',
        'tanggal_kerja',
        'catatan',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kerja' => 'date',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function anggotaJadwal()
    {
        return $this->hasMany(AnggotaJadwal::class);
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOM RELATION
    |--------------------------------------------------------------------------
    */

    public function leader()
    {
        return $this->hasMany(AnggotaJadwal::class)
            ->where('tipe_role', 'leader');
    }

    public function operator()
    {
        return $this->hasMany(AnggotaJadwal::class)
            ->where('tipe_role', 'operator');
    }
}