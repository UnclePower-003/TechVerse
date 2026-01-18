<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactHeader extends Model
{
    protected $fillable = ['title', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
