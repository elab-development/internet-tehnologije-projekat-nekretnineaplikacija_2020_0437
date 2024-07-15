<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function index()
    {
        return RatingResource::collection(Rating::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'rating_value' => 'required|integer|min:1|max:10',
            'description' => 'nullable|string',
            'rating_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $rating = Rating::create($request->all());

        return response()->json([
            'message' => 'Ocena je uspešno kreirana.',
            'ocena' => new RatingResource($rating)
        ], 201);
    }

    public function show($id)
    {
        return new RatingResource(Rating::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'rating_value' => 'required|integer|min:1|max:10',
            'description' => 'nullable|string',
            'rating_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $rating->update($request->all());

        return response()->json([
            'message' => 'Ocena je uspešno ažurirana.',
            'ocena' => new RatingResource($rating)
        ], 200);
    }

    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return response()->json(['message' => 'Ocena je uspešno obrisana.'], 200);
    }
}
