<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PropertyResource::collection(Property::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'property_type_id' => 'required|exists:property_types,id',
            'bedrooms' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } 
      $property = Property::create($request->except('images'));

      foreach ($request->file('images') as $image) {
        $path = $image->store('property_images');  //property_images/dsdadsa.jpg
        $property->images()->create([
            'url' => $path,
            'description' => 'slika '.$path,
        ]);

      }

        return response()->json([
            'message' => 'Nekretnina je uspešno kreirana.',
            'nekretnina'=> new PropertyResource($property)
         ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PropertyResource(Property::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
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
 

    public function search(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string',
            'title' => 'nullable|string',
            'property_type_id' => 'nullable|exists:property_types,id',
            'bedrooms' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

    
        $query = Property::query();

        
        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('property_type_id')) {
            $query->where('property_type_id', $request->input('property_type_id'));
        }

        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        
        $properties = $query->get();

        return PropertyResource::collection($properties);
    }

}
