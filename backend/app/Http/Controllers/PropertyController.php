<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    public function index()
    {
        return PropertyResource::collection(Property::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'property_type_id' => 'required|exists:property_types,id',
            'bedrooms' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $property = Property::create($request->all());

        return response()->json([
            'message' => 'Nekretnina je uspešno kreirana.',
            'nekretnina'=> new PropertyResource($property)
         ], 201);
    }

    public function show($id)
    {
        return new PropertyResource(Property::findOrFail($id));
    }

    public function update(Request $request,  $id)
    {
        $property = Property::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'property_type_id' => 'required|exists:property_types,id',
            'bedrooms' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $property->update($request->all());

        return response()->json([
            'message' => 'Nekretnina je uspešno azurirana.',
            'nekretnina'=> new PropertyResource($property)
         ], 200);
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $property->purchases()->delete();

        foreach ($property->images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }

        $property->delete();
        return response()->json(['message' => 'Nekretnina je uspešno obrisana.'], 200);
    }
}
