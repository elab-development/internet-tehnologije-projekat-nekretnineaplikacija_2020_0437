<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            [
                'user_id' => 1,
                'property_id' => 3,
                'rating_value' => 7,
                'rating_date' => now()->subDays(rand(1,30)),  
            ],
            [
                'user_id' => 1,
                'property_id' => 9,
                'rating_value' => 9,
                'rating_date' => now()->subDays(rand(1,30)), 
            ],
            [
                'user_id' => 2,
                'property_id' => 6,
                'rating_value' => 3,
                'rating_date' => now()->subDays(rand(1,30)),  
            ],
        ];
        
        DB::table('ratings')->insert($ratings);
    }
}
