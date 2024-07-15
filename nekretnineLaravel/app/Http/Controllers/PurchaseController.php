<?php
namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Models\Property;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index()
    {
        return PurchaseResource::collection(Purchase::all());
    }

    public function store(Request $request)
    {
        // Validacija  
        $validator = Validator::make($request->all(), [
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]); 
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Provera rezervacija za odabrane datume
        $existingReservation = Purchase::where('property_id', $request->property_id)
                                        ->where(function($query) use ($request) {
                                            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                                                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
                                        })
                                        ->exists();
    
        // Ako već postoji rezervacija za odabrane datume, vratimo grešku
        if ($existingReservation) {
            return response()->json(['message' => 'Nekretnina je već rezervisana za odabrane datume.'], 400);
        }
    
        // Izračunavanje cijene transakcije na osnovu broja dana i cene po danu nekretnine
        $property = Property::findOrFail($request->property_id);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $number_of_days = $end_date->diffInDays($start_date);
        $transaction_amount = $number_of_days * $property->price_per_day;
    
        // Stvaranje nove rezervacije
        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json(['message' => 'Korisnik nije pronađen.'], 404);
        } 
        $request->merge(['user_id' => $user_id, 'transaction_amount' => $transaction_amount]); 
        $purchase = Purchase::create($request->all());
    
        // Odgovor s uspešnom rezervacijom
        return response()->json([
            'message' => 'Kupovina je uspešno kreirana.',
            'kupovina' => new PurchaseResource($purchase)
        ], 201);
    }
    
    

    public function show($id)
    {
        return new PurchaseResource(Purchase::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'transaction_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $purchase->update($request->all());

        return response()->json([
            'message' => 'Kupovina je uspešno ažurirana.',
            'kupovina' => new PurchaseResource($purchase)
        ], 200);
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return response()->json(['message' => 'Kupovina je uspešno obrisana.'], 200);
    }
}
