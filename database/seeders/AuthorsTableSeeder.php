<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author; // Pastikan ini sesuai dengan model Author
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Menggunakan Eloquent
        Author::insert([
            ['name' => 'Author 1'],
            ['name' => 'Author 2'],
            ['name' => 'Author 3'],
        ]);

        // Atau menggunakan DB facade
        /*
        DB::table('authors')->insert([
            ['name' => 'Author 1'],
            ['name' => 'Author 2'],
            ['name' => 'Author 3'],
        ]);
        */
    }
}
