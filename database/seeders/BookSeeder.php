<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory(100)->create([
        ])->each(function ($book) {
            $book->genres()->attach(Genre::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        });
    }
}
