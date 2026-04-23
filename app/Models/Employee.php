<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'gender',
        'alamat',
        'notelp',
        'jabatan',
        'jenis_kontrak_id'
    ];

    // 🔗 ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Jenis Kontrak
    public function jenisKontrak()
    {
        return $this->belongsTo(Contract::class, 'jenis_kontrak_id');
    }

    // 🔗 Jadwal sebagai operator
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // 🔗 Jadwal sebagai leader (🔥 penting)
    public function leaderSchedules()
    {
        return $this->hasMany(Schedule::class, 'leader_id');
    }

    // 🔗 Swap sebagai requester
    public function requestedSwaps()
    {
        return $this->hasMany(ShiftSwap::class, 'requester_id');
    }

    // 🔗 Swap sebagai target
    public function targetSwaps()
    {
        return $this->hasMany(ShiftSwap::class, 'target_id');
    }

    // 🔗 History
    public function histories()
    {
        return $this->hasMany(ShiftHistory::class);
    }
}