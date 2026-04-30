<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'affiliate_id',
        'customer_name',
        'phone_number',
        'email',
        'address',
        'preferred_date',
        'status',
        'total_price',
        'notes',
        'label',
    ];

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
}
