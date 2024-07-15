<?php

namespace App\Http\Controllers;

use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = PropertyImage::all();
        return response()->json($images);
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
            'property_id' => 'required|exists:properties,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validacija za sliku
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Čuvanje slike u storage-u
        $imagePath = $request->file('image')->store('property_images');

        $image = PropertyImage::create([
            'property_id' => $request->property_id,
            'url' => $imagePath,
            'description' => $request->description,
        ]);

        return response()->json($image, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = PropertyImage::findOrFail($id);
        return response()->json($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = PropertyImage::findOrFail($id);
        
        // Brisanje slike iz storage-a
        Storage::delete($image->url);

        $image->delete();
        return response()->json(null, 204);
    }
}
