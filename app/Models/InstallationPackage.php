<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationPackage extends Model
{
    protected $fillable = [
        'category',
        'name',
        'price',
        'price_unit',
        'features',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
