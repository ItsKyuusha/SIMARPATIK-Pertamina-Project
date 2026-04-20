<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leader = User::where('role', 'leader')->first();
        $operator = User::where('role', 'operator')->first();

        $leaderEmployee = Employee::create([
            'user_id' => $leader->id,
            'nama' => 'Leader 1',
            'nik' => 'L001',
        ]);

        Employee::create([
            'user_id' => $operator->id,
            'nama' => 'Operator 1',
            'nik' => 'O001',
            'leader_id' => $leaderEmployee->id
        ]);
            }
}
