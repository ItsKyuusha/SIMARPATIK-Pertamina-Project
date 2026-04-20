<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'kode_shift',
        'jam_masuk',
        'jam_keluar'
    ];

    protected $casts = [
        'jam_masuk' => 'datetime:H:i',
        'jam_keluar' => 'datetime:H:i',
    ];

    // 🔗 Jadwal
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // 🔗 History
    public function histories()
    {
        return $this->hasMany(ShiftHistory::class);
    }
}
