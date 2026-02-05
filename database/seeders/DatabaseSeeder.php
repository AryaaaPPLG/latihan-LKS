<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Cuy',
            'email' => 'admin@sekolah.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Siswa Cuy',
            'email' => 'siswa@sekolah.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
    }
}
