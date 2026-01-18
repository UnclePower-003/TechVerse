<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = ['items', 'is_active'];

    protected $casts = [
        'items' => 'array', // cast JSON to array automatically
        'is_active' => 'boolean',
    ];
}
