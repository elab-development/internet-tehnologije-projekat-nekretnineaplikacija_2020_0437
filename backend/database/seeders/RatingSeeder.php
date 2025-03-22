<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('ratings')->insert([
                'user_id' => rand(1, 4), // Slučajno odabrani korisnik
                'property_id' => rand(1, 10), // Slučajno odabrana nekretnina
                'rating_value' => rand(1, 10), // Slučajno generisana brojčana ocena od 1 do 10
                'description' => 'Ocena broj ' . $i, // Dodajte neki opis ocene
                'rating_date' => now()->subDays(rand(1, 30)), // Slučajno generisani datum ocene unutar poslednjih 30 dana
            ]);
        }
    }
}
