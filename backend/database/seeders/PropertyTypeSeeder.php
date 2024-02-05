<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('property_types')->insert([
            'name' => 'Stan',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Kuca',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Garsonjera',
        ]);

        DB::table('property_types')->insert([
            'name' => 'Vikendica',
        ]);

    }
}
