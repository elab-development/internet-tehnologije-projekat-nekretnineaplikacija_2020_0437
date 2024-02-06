<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchases = [
            [
                'user_id' => 1,
                'property_id' => 3,
                'transaction_amount' => 73000,
                'date' => now()->subDays(rand(1,30)),  
            ],
            [
                'user_id' => 2,
                'property_id' => 10,
                'transaction_amount' => 280000,
                'date' => now()->subDays(rand(1,30)),  
            ],
            [
                'user_id' => 2,
                'property_id' => 8,
                'transaction_amount' => 400000,
                'date' => now()->subDays(rand(1,30)),  
            ],
            [
                'user_id' => 3,
                'property_id' => 3,
                'transaction_amount' => 73000,
                'date' => now()->subDays(rand(1,30)),  
            ],
        ];
        
        DB::table('purchases')->insert($purchases);
    }
}
