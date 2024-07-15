<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikaController extends Controller
{
    public function statistics()
    {
        // Dobijanje statistike za top 5 nekretnina
        $topProperties = Property::select('properties.id', 'properties.title', DB::raw('COUNT(purchases.id) as reservations_count'))
            ->leftJoin('purchases', 'properties.id', '=', 'purchases.property_id')
            ->groupBy('properties.id', 'properties.title')
            ->orderByDesc('reservations_count')
            ->take(5)
            ->get();

        // Dobijanje statistike za broj registrovanih korisnika po mesecima
        $userRegistrations = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as registrations_count')
        )
            ->whereYear('created_at', '=', date('Y')) // Filtriranje samo po tekućoj godini
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json([
            'top_properties' => $topProperties,
            'user_registrations' => $userRegistrations,
        ]);
    }
}
