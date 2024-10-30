<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan pemanggilan seeder di sini
        $this->call([
            AuthorsTableSeeder::class,
            BooksTableSeeder::class,
        ]);

        // Seeder User (Factory)
        User::factory(10)->create(); // Menggunakan factory untuk membuat 10 data user

        // Membuat user spesifik
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
