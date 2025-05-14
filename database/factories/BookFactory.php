<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Enums\BookStatus;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'title' => fake()->sentence(5),
            'author' => fake()->name(),
            'publication_year' => now()->year - fake()->numberBetween(1, 100),
            'status' => fake()->boolean(80) ? Arr::random(BookStatus::cases())->value : NULL,
            'ranking' => fake()->boolean(85) ? fake()->numberBetween(3, 5) : fake()->numberBetween(1, 2), // 15% terrible books
            'user_id' => fake()->randomElement($userIds),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
