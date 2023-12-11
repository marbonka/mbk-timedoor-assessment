<?php

namespace Database\Factories;

use Database\Seeders\AuthorSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_name' => ucwords(fake()->sentence(3)),
            'category_id' => rand(1,CategorySeeder::REQUIRED_ROWS),
            'author_id' => rand(1,AuthorSeeder::REQUIRED_ROWS)
        ];
    }
}
