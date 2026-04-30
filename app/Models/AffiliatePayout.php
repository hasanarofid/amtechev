<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliatePayout extends Model
{
    protected $fillable = [
        'affiliate_id',
        'amount',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'notes',
    ];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
}
