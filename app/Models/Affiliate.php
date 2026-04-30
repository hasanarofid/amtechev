<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $fillable = [
        'user_id',
        'referral_code',
        'commission_rate',
        'balance',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visits()
    {
        return $this->hasMany(AffiliateVisit::class);
    }

    public function commissions()
    {
        return $this->hasMany(AffiliateCommission::class);
    }

    public function payouts()
    {
        return $this->hasMany(AffiliatePayout::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
