<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Kontrak;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $kontrak = Kontrak::first();

        if (!$kontrak) {
            $kontrak = Kontrak::create([
                'nama_kontrak' => 'Kontrak Tetap'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | LEADER
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 8; $i++) {

            $user = User::create([
                'role' => 'leader',
                'username' => 'leader' . $i,
                'email' => 'leader' . $i . '@gmail.com',
                'password' => Hash::make('password'),
            ]);

            Karyawan::create([
                'user_id' => $user->id,
                'kontrak_id' => $kontrak->id,
                'kode_karyawan' => 'LDR-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nip' => '2000' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama_lengkap' => 'Leader ' . $i,
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'no_telp' => '0812345678' . $i,
                'alamat' => 'Alamat Leader ' . $i,
                'jabatan' => 'Leader',
                'tanggal_masuk' => now()->subDays(rand(1, 365)),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | OPERATOR
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 20; $i++) {

            $user = User::create([
                'role' => 'operator',
                'username' => 'operator' . $i,
                'email' => 'operator' . $i . '@gmail.com',
                'password' => Hash::make('password'),
            ]);

            Karyawan::create([
                'user_id' => $user->id,
                'kontrak_id' => $kontrak->id,
                'kode_karyawan' => 'OPR-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nip' => '3000' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama_lengkap' => 'Operator ' . $i,
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'no_telp' => '0823456789' . $i,
                'alamat' => 'Alamat Operator ' . $i,
                'jabatan' => 'Operator',
                'tanggal_masuk' => now()->subDays(rand(1, 365)),
            ]);
        }
    }
}