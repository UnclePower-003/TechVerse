<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactHero extends Model
{
    protected $fillable = ['image_mobile', 'image_tablet', 'image_desktop', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
