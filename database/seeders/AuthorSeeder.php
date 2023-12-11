<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public const REQUIRED_ROWS = 1000;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()->count(self::REQUIRED_ROWS)->create();
    }
}
