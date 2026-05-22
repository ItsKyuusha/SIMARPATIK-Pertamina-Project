<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalPengajuan extends Model
{
    use HasFactory;

    protected $table = 'approval_pengajuan';

    protected $fillable = [
        'pengajuan_id',
        'approver_id',
        'status_approval',
        'catatan',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function pengajuan()
    {
        return $this->belongsTo(
            PengajuanTukarShift::class,
            'pengajuan_id'
        );
    }

    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approver_id'
        );
    }
}