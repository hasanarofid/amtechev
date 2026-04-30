<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateVisit extends Model
{
    protected $fillable = [
        'affiliate_id',
        'ip_address',
        'user_agent',
        'referrer_url',
    ];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
}
