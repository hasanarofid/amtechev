<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'affiliate_id',
        'user_id',
        'service_id',
        'charger_id',
        'order_number',
        'status',
        'total_price',
        'notes',
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_city',
        'customer_postcode',
        'customer_state',
        'customer_country',
        'payment_method',
        'payment_status',
        'bayarcash_transaction_id',
        'payment_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function charger()
    {
        return $this->belongsTo(Charger::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
