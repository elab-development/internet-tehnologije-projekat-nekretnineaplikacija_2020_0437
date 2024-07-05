<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('purchases')->insert([
                'user_id' => rand(1, 4), // Slučajno odabrani korisnik
                'property_id' => rand(1, 10), // Slučajno odabrana nekretnina
                'transaction_amount' => rand(500, 1000), // Slučajno generisani iznos transakcije
                'start_date' => now()->subDays(rand(1, 30)), // Slučajno generisani datum početka iznajmljivanja unutar poslednjih 30 dana
                'end_date' => now()->addDays(rand(1, 30)), // Slučajno generisani datum završetka iznajmljivanja unutar narednih 30 dana
            ]);
        }
    }
}
