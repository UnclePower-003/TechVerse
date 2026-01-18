<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    protected $fillable = ['icon', 'title', 'subtitle', 'description', 'tags', 'animation_delay', 'is_active'];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];
}
