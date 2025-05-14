<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GenreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genres = array_map(fn($genre) => ['name' => $genre, 'created_at' => now(), 'updated_at' => now()], [
            "Adventure",
            "Art",
            "Autobiography",
            "Business",
            "Childrens",
            "Comics",
            "Computer Science",
            "Cookbooks",
            "Crafts",
            "Crime",
            "Cultural Studies",
            "Dictionaries",
            "Drama",
            "Dystopian",
            "Economics",
            "Education",
            "Encyclopedias",
            "Engineering",
            "Environmental Science",
            "Essay",
            "Fairy Tales",
            "Fantasy",
            "Feminist Literature",
            "Fiction",
            "Folklore",
            "Food And Drink",
            "Games",
            "Gardening",
            "Graphic Novel",
            "Health",
            "Historical Fiction",
            "History",
            "Hobbies",
            "Home Improvement",
            "Horror",
            "Humor",
            "Indigenous Literature",
            "Journalism",
            "Language",
            "Latin American Literature",
            "Lgbtq Literature",
            "Literary Fiction",
            "Magical Realism",
            "Mathematics",
            "Music",
            "Mystery",
            "Mythology",
            "Nature",
            "Non Fiction",
            "Paranormal",
            "Parenting",
            "Philosophy",
            "Photography",
            "Plays",
            "Poetry",
            "Political Science",
            "Post Apocalyptic",
            "Psychology",
            "Reference",
            "Religion",
            "Romance",
            "Satire",
            "Science Fiction",
            "Science",
            "Screenplays",
            "Self Help",
            "Sociology",
            "Speculative Fiction",
            "Spirituality",
            "Sports",
            "Study Aids",
            "Technology",
            "Thriller",
            "Travel",
            "True Crime",
            "War",
            "Western",
            "Young Adult",
        ]);

        Genre::insert($genres);
    }
}
