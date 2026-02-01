<?php

// app/Models/ProductsHeader.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsHeader extends Model
{
    protected $fillable = ['title', 'highlight_text', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
