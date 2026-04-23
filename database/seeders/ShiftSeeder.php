<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            ['P', '07:00', '14:50'],
            ['S', '15:00', '23:59'],
            ['M', '00:00', '06:59'],
            ['P1', '09:00', '17:59'],
            ['S1', '18:00', '01:59'],
            ['L', '00:00', '00:00'],
        ];

        foreach ($shifts as $shift) {
            Shift::create([
                'kode_shift' => $shift[0],
                'jam_masuk' => $shift[1],
                'jam_keluar' => $shift[2],
            ]);
        }
    }
}
