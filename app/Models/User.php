<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'role',
        'username',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class);
    }

    public function jadwalDibuat()
    {
        return $this->hasMany(Jadwal::class, 'dibuat_oleh');
    }

    public function approvalPengajuan()
    {
        return $this->hasMany(ApprovalPengajuan::class, 'approver_id');
    }

    public function pengajuanDisetujui()
    {
        return $this->hasMany(PengajuanTukarShift::class, 'disetujui_oleh');
    }

    public function riwayatPerubahan()
    {
        return $this->hasMany(RiwayatShift::class, 'diubah_oleh');
    }
}