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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pera Perić',
            'email' => 'kupac1@gmail.com',
            'password' => Hash::make('password'),  
            'role' => 'kupac',
        ]);

        DB::table('users')->insert([
            'name' => 'Mika Mikić',
            'email' => 'kupac2@gmail.com',
            'password' => Hash::make('password'),  
            'role' => 'kupac',
        ]);
   
        DB::table('users')->insert([
            'name' => 'Janko Janković',
            'email' => 'prodavac1@gmail.com',
            'password' => Hash::make('password'),  
            'role' => 'prodavac',
        ]);

        DB::table('users')->insert([
            'name' => 'Zoran Zoranić',
            'email' => 'prodavac2@gmail.com',
            'password' => Hash::make('password'),  
            'role' => 'prodavac',
        ]);


        $this->call(PropertyTypeSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(PurchaseSeeder::class);
        $this->call(RatingSeeder::class);





    }
}
