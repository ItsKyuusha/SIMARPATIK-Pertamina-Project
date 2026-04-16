<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Management',
            'email' => 'management@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'management'
        ]);

        User::create([
            'name' => 'Leader User',
            'email' => 'leader@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'leader'
        ]);

        User::create([
            'name' => 'Operator User',
            'email' => 'operator@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'operator'
        ]);
    }
}
