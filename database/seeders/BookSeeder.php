<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public const REQUIRED_ROWS = 100000;
    private $iteration = 1;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newData = [];
        $before = microtime(true);
        for($i = 0; $i < self::REQUIRED_ROWS;$i++){
            $newData[] = [
                'book_name' => ucwords(fake()->sentence(3)),
                'category_id' => rand(1,CategorySeeder::REQUIRED_ROWS),
                'author_id' => rand(1,AuthorSeeder::REQUIRED_ROWS)
            ];
        }
        $after = microtime(true);
        $this->command->line("Data creation finished in ".number_format(($after - $before)*1000,2)." ms");

        foreach(array_chunk($newData, 1000) as $arrChunk){
            $before = microtime(true);
            Book::insert($arrChunk);
            $after = microtime(true);
            $this->command->line("Data chunk per 1000 insertion #".$this->iteration." finished in ".number_format(($after - $before)*1000,2)." ms");
            $this->iteration++;
        }

    }
}
