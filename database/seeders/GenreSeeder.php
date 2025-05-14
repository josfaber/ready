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
            "adventure",
            "art",
            "autobiography",
            "business",
            "childrens",
            "comics",
            "computer-science",
            "cookbooks",
            "crafts",
            "crime",
            "cultural-studies",
            "dictionaries",
            "drama",
            "dystopian",
            "economics",
            "education",
            "encyclopedias",
            "engineering",
            "environmental-science",
            "essay",
            "fairy-tales",
            "fantasy",
            "feminist-literature",
            "fiction",
            "folklore",
            "food-and-drink",
            "games",
            "gardening",
            "graphic-novel",
            "health",
            "historical-fiction",
            "history",
            "hobbies",
            "home-improvement",
            "horror",
            "humor",
            "indigenous-literature",
            "journalism",
            "language",
            "latin-american-literature",
            "lgbtq-literature",
            "literary-fiction",
            "magical-realism",
            "mathematics",
            "music",
            "mystery",
            "mythology",
            "nature",
            "non-fiction",
            "paranormal",
            "parenting",
            "philosophy",
            "photography",
            "plays",
            "poetry",
            "political-science",
            "post-apocalyptic",
            "psychology",
            "reference",
            "religion",
            "romance",
            "satire",
            "science-fiction",
            "science",
            "screenplays",
            "self-help",
            "sociology",
            "speculative-fiction",
            "spirituality",
            "sports",
            "study-aids",
            "technology",
            "thriller",
            "travel",
            "true-crime",
            "war",
            "western",
            "young-adult",
        ]);

        Genre::insert($genres);
    }
}
