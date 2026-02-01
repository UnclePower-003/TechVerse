<?php

// app/Models/ProductsHero.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsHero extends Model
{
    protected $fillable = [
        'mobile_image',
        'tablet_image',
        'desktop_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
