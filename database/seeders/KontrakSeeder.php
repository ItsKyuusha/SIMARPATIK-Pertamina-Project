<?php

namespace Database\Seeders;

use App\Models\Kontrak;
use Illuminate\Database\Seeder;

class KontrakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_kontrak' => 'Harian',
            ],
            [
                'nama_kontrak' => 'Bulanan',
            ],
        ];

        foreach ($data as $item) {
            Kontrak::updateOrCreate(
                ['nama_kontrak' => $item['nama_kontrak']],
                $item
            );
        }
    }
}