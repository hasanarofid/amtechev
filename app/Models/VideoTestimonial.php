<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoTestimonial extends Model
{
    protected $fillable = [
        'title',
        'customer_name',
        'video_path',
        'thumbnail_path',
        'is_published',
        'sort_order',
    ];
}
