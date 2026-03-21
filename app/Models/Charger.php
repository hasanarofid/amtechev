<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug',
        'description', 
        'price', 
        'image_url', 
        'images',
        'specifications',
        'product_info',
        'installation_info',
        'why_choose_us',
        'is_featured'
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
    ];
}
