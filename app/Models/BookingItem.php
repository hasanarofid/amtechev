<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'installation_package_id',
        'quantity',
        'price_at_booking',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function installationPackage()
    {
        return $this->belongsTo(InstallationPackage::class);
    }
}
