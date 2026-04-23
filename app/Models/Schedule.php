<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'employee_id',
        'shift_id',
        'leader_id',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    // 🔗 Operator
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // 🔗 Shift
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    // 🔗 Leader (🔥 INI KUNCI)
    public function leader()
    {
        return $this->belongsTo(Employee::class, 'leader_id');
    }

    // 🔗 Swap
    public function swaps()
    {
        return $this->hasMany(ShiftSwap::class);
    }
}
