<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use App\Models\Contract;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $leader = User::where('role', 'leader')->first();
        $operator = User::where('role', 'operator')->first();

        $kontrakHarian = Contract::where('nama_kontrak', 'Harian')->first();
        $kontrakBulanan = Contract::where('nama_kontrak', 'Bulanan')->first();

        $leaderEmployee = Employee::create([
            'user_id' => $leader->id,
            'nama' => 'Leader 1',
            'nip' => 'L001',
            'gender' => 'L',
            'alamat' => 'Semarang',
            'notelp' => '081234567890',
            'jabatan' => 'Leader',
            'jenis_kontrak_id' => $kontrakBulanan?->id
        ]);

        Employee::create([
            'user_id' => $operator->id,
            'nama' => 'Operator 1',
            'nip' => 'O001',
            'leader_id' => $leaderEmployee->id,
            'gender' => 'L',
            'alamat' => 'Semarang',
            'notelp' => '081298765432',
            'jabatan' => 'Operator',
            'jenis_kontrak_id' => $kontrakHarian?->id
        ]);
    }
}