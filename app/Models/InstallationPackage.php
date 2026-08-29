<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallationPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category',
        'name',
        'price',
        'price_3phase',
        'price_unit',
        'features',
        'addons',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'addons' => 'array',
        'is_active' => 'boolean',
        'price' => 'float',
        'price_3phase' => 'float',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
