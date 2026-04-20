<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'leader_id'
    ];

    // 🔗 ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Leader (self relation)
    public function leader()
    {
        return $this->belongsTo(Employee::class, 'leader_id');
    }

    // 🔗 Anak buah (operator di bawah leader)
    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'leader_id');
    }

    // 🔗 Jadwal
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
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
