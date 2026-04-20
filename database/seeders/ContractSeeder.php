<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contract;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contract::create([
            'nama_kontrak' => 'Harian',
            'deskripsi' => 'Kontrak harian'
        ]);

        Contract::create([
            'nama_kontrak' => 'Bulanan',
            'deskripsi' => 'Kontrak bulanan'
        ]);
            }
}
