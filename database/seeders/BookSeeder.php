<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
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
        // All users, but the admin which has id === 1
        $userIds = array_diff(User::pluck('id')->toArray(), [1]);

        Book::factory(100)->create([
            'user_id' => fn () => fake()->randomElement($userIds),
        ])->each(function ($book) {
            $book->genres()->attach(Genre::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        });
    }
}
