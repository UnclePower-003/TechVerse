<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

// app/Models/Category.php
class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
