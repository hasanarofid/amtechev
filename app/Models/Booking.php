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
        'preferred_date',
        'status',
        'total_price',
        'notes',
    ];


    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }
}
