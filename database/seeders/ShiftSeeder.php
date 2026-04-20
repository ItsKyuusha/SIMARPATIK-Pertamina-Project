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
            ['P', '07:00', '15:00'],
            ['S', '15:00', '23:00'],
            ['M', '23:00', '07:00'],
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
