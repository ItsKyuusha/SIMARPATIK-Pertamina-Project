<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftHistory extends Model
{
    protected $fillable = [
        'employee_id',
        'shift_id',
        'tanggal',
        'keterangan'
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
}
