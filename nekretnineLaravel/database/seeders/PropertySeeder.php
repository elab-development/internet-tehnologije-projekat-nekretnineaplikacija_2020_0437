<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'title' => 'Lep stan u centru grada',
                'description' => 'Prostran i moderno opremljen stan sa 2 spavaće sobe i balkonom.',
                'price' => 120000,
                'property_type_id' => 1,
                'bedrooms' => 2,
               
            ],
            [
                'title' => 'Porodična kuća sa bazenom',
                'description' => 'Velika kuća sa 4 spavaće sobe, bazenom i prelepim dvorištem.',
                'price' => 320000,
                'property_type_id' => 2,
                'bedrooms' => 4,
                
            ],
            [
                'title' => 'Apartman u blizini plaže',
                'description' => 'Savremeno uređen apartman sa 1 spavaćom sobom, na samo nekoliko koraka od plaže.',
                'price' => 85000,
                'property_type_id' => 3,
                'bedrooms' => 1,
              
            ],
            [
                'title' => 'Vikendica u prirodi',
                'description' => 'Šarmantna vikendica sa 2 spavaće sobe, okružena prirodom i planinama.',
                'price' => 65000,
                'property_type_id' => 4,
                'bedrooms' => 2,
                
            ],
            [
                'title' => 'Poslovni prostor u poslovnom centru',
                'description' => 'Moderan poslovni prostor sa više kancelarija, konferencijskom salom i recepcijom.',
                'price' => 200000,
                'property_type_id' => 5,
                'bedrooms' => 0,
              
            ],
            [
                'title' => 'Stan sa panoramskim pogledom',
                'description' => 'Elegantan stan sa 3 spavaće sobe i velikim prozorima sa panoramskim pogledom na grad.',
                'price' => 280000,
                'property_type_id' => 1,
                'bedrooms' => 3,
               
            ],
            [
                'title' => 'Kuća na jezeru',
                'description' => 'Prelepa kuća sa 5 spavaćih soba, privatnim pristupom jezeru i ribnjakom.',
                'price' => 450000,
                'property_type_id' => 2,
                'bedrooms' => 5,
                
            ],
            [
                'title' => 'Ekskluzivni penthouse',
                'description' => 'Luksuzni penthouse sa 4 spavaće sobe, terasom i privatnim liftom.',
                'price' => 750000,
                'property_type_id' => 3,
                'bedrooms' => 4,
               
            ],
            [
                'title' => 'Planinska koliba',
                'description' => 'Šarmantna koliba sa 2 spavaće sobe, okružena šumom i planinama.',
                'price' => 55000,
                'property_type_id' => 4,
                'bedrooms' => 2,
             
            ],
            [
                'title' => 'Poslovni prostor u centru grada',
                'description' => 'Prostran poslovni prostor sa otvorenim prostorom za rad i modernom opremom.',
                'price' => 180000,
                'property_type_id' => 5,
                'bedrooms' => 0,
              
            ],
        ];

        
        DB::table('properties')->insert($properties);

    }
}
