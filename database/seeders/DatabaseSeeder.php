<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Siswa Cuy',
            'email' => 'siswa@sekolah.id',
            'role' => 'siswa',
        ]);
    }
}
