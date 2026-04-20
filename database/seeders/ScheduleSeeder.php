<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Shift;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = Employee::first();
        $shift = Shift::first();

        Schedule::create([
            'employee_id' => $employee->id,
            'shift_id' => $shift->id,
            'tanggal' => now()->toDateString(),
        ]);
    }
}
