<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Product.php
class Product extends Model
{
    protected $fillable = ['category_id', 'model', 'title', 'price', 'image', 'badge_text', 'badge_color', 'specs'];

    protected $casts = [
        'specs' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
