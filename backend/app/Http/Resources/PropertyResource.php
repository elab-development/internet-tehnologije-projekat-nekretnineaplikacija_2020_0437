<?php

namespace App\Http\Resources;

use App\Models\PropertyImage;
use App\Models\PropertyType;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    { 
       $images = PropertyImage::where('property_id', $this->id)->get();

       
       $imageUrls = [];
       foreach ($images as $image) {
        // Ovde koristimo url() pomoćnu funkciju da generišemo URL prema simboličkom linku
            $imageUrls[] = url("storage/{$image->url}");
        }

       return [
           'id' => $this->id,
           'title' => $this->title,
           'description' => $this->description,
           'price' => $this->price,
           'bedrooms' => $this->bedrooms,
           'propery_type' => PropertyType::find($this->property_type_id),
           'images' => $imageUrls,
       ];
    }
}
