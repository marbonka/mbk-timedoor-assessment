<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public const REQUIRED_ROWS = 500000;
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
                'book_id' => rand(1,BookSeeder::REQUIRED_ROWS),
                'rating_value' => rand(1,10)
            ];
        }
        $after = microtime(true);
        $this->command->line("Data creation finished in ".number_format(($after - $before)*1000,2)." ms");

        foreach(array_chunk($newData, 1000) as $arrChunk){
            $before = microtime(true);
            Rating::insert($arrChunk);
            $after = microtime(true);
            $this->command->line("Data chunk per 1000 insertion #".$this->iteration." finished in ".number_format(($after - $before)*1000,2)." ms");
            $this->iteration++;
        }
    }
}
