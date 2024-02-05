<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Filip Trifunovic',
            'email' => 'f@gmail.com',
            'password' => Hash::make('filip'),  
            'role' => 'kupac',
        ]);

        DB::table('users')->insert([
            'name' => 'Ana Borovina',
            'email' => 'a@gmail.com',
            'password' => Hash::make('ana'),  
            'role' => 'kupac',
        ]);
   
        DB::table('users')->insert([
            'name' => 'Marko Markovic',
            'email' => 'm@gmail.com',
            'password' => Hash::make('marko'),  
            'role' => 'prodavac',
        ]);


        $this->call(PropertyTypeSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(PurchaseSeeder::class);
        $this->call(RatingSeeder::class);

    }
}
