<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book; // Pastikan ini sesuai dengan model Book
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua ID dari tabel authors
        $authors = Author::all();

        foreach ($authors as $author) {
            Book::create([
                'title' => 'Sample Book by ' . $author->name,
                'price' => rand(10000, 50000),
                'description' => 'Sample description for book by ' . $author->name,
                'date_of_publication' => now()->subYears(rand(1, 10)),
                'author_id' => $author->id, // Hubungkan dengan author_id
            ]);
        }
    }
}
