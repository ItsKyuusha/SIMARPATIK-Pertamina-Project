<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'employee_id',
        'shift_id',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    // 🔗 Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // 🔗 Shift
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    // 🔗 Swap
    public function swaps()
    {
        return $this->hasMany(ShiftSwap::class);
    }
}
