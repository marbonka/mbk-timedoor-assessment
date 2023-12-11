<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public const REQUIRED_ROWS = 3000;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(self::REQUIRED_ROWS)->create();
    }
}
