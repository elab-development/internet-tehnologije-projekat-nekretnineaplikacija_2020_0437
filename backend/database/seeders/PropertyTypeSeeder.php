<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_types')->insert([
            'name' => 'Stan',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Kuća',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Apartman',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Vikendica',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Poslovni prostor',
        ]);
    }
}
