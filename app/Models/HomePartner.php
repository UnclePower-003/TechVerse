<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePartner extends Model
{
    protected $fillable = ['icon', 'name', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
