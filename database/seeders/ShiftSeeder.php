<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_shift' => 'P',
                'nama_shift' => 'Pagi',
                'jam_masuk' => '07:00:00',
                'jam_keluar' => '15:59:00',
            ],
            [
                'kode_shift' => 'S',
                'nama_shift' => 'Sore',
                'jam_masuk' => '16:00:00',
                'jam_keluar' => '23:59:00',
            ],
            [
                'kode_shift' => 'M',
                'nama_shift' => 'Malam',
                'jam_masuk' => '00:00:00',
                'jam_keluar' => '06:59:00',
            ],
        ];

        foreach ($data as $item) {
            Shift::updateOrCreate(
                ['kode_shift' => $item['kode_shift']],
                $item
            );
        }
    }
}