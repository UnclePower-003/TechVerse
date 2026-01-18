<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHeader extends Model
{
    protected $fillable = ['badge_text', 'heading_main', 'heading_gradient', 'description', 'features', 'is_active'];

    protected $casts = [
        'features' => 'array', // JSON cast
        'is_active' => 'boolean',
    ];
}
