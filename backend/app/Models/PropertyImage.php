<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',  
        'url', // Putanja do slike
        'description', // Opis slike  
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
