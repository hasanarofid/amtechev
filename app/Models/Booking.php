<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_name',
        'phone_number',
        'email',
        'address',
        'installation_package_id',
        'status',
        'notes',
    ];

    public function installationPackage()
    {
        return $this->belongsTo(InstallationPackage::class);
    }
}
