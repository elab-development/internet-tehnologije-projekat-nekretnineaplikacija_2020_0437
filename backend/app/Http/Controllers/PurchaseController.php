<?php
namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index()
    {
        return PurchaseResource::collection(Purchase::all());
    }

    public function store(Request $request)
    {
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

        $purchase = Purchase::create($request->all());

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
