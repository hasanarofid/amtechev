<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiktokVideo extends Model
{
    protected $fillable = [
        'title',
        'video_id',
        'is_active',
        'sort_order',
    ];
}
