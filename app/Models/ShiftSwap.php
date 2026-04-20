<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftSwap extends Model
{
    protected $fillable = [
        'requester_id',
        'target_id',
        'schedule_id',
        'status',
        'approved_by_leader',
        'approved_by_management'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // 🔗 Employee (requester)
    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id');
    }

    // 🔗 Employee (target)
    public function target()
    {
        return $this->belongsTo(Employee::class, 'target_id');
    }

    // 🔗 Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // 🔗 Approver Leader
    public function leaderApprover()
    {
        return $this->belongsTo(User::class, 'approved_by_leader');
    }

    // 🔗 Approver Management
    public function managementApprover()
    {
        return $this->belongsTo(User::class, 'approved_by_management');
    }
}
