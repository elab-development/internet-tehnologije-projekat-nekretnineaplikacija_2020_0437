<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'title' => 'Stan 1',
                'description' => 'Trosoban stan u centru Beograda',
                'price' => 180000,
                'property_type_id' => 1,
                'bedrooms' => 3,
               
            ],
            [
                'title' => 'Stan 2',
                'description' => 'Prostran porodicni stan na Zvezdari',
                'price' => 255000,
                'property_type_id' => 1,
                'bedrooms' => 4,
                
            ],
            [
                'title' => 'Garsonjera 1',
                'description' => 'Jednosobna garsonjera u Surcinu',
                'price' => 73000,
                'property_type_id' => 3,
                'bedrooms' => 1,
              
            ],
            [
                'title' => 'Kuca 1',
                'description' => 'Kuca na obodu Beograda sa pogledom na Dunav',
                'price' => 135000,
                'property_type_id' => 2,
                'bedrooms' => 2,
                
            ],
            [
                'title' => 'Kuca 2',
                'description' => 'Moderna kuca na Bezanijskoj kosi',
                'price' => 700000,
                'property_type_id' => 2,
                'bedrooms' => 6,
              
            ],
            [
                'title' => 'Stan 3',
                'description' => 'Dvosoban stan u Novom Sadu',
                'price' => 150000,
                'property_type_id' => 1,
                'bedrooms' => 2,
               
            ],
            [
                'title' => 'Vikendica 1',
                'description' => 'Vikendica na Staroj planini',
                'price' => 200000,
                'property_type_id' => 4,
                'bedrooms' => 4,
                
            ],
            [
                'title' => 'Stan 4',
                'description' => 'Luksuzni stan u Beogradu na vodi',
                'price' => 400000,
                'property_type_id' => 1,
                'bedrooms' => 2,
               
            ],
            [
                'title' => 'Garsonjera 2',
                'description' => 'Garsonjera u Kraljevu',
                'price' => 55000,
                'property_type_id' => 3,
                'bedrooms' => 1,
             
            ],
            [
                'title' => 'Kuca 3',
                'description' => 'Kuca sa unutrasnjim bazenom i saunom',
                'price' => 280000,
                'property_type_id' => 2,
                'bedrooms' => 3,
              
            ],
        ];

        
        DB::table('properties')->insert($properties);
    }
}
