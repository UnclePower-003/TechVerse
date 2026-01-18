<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSupportPromise extends Model
{
    protected $fillable = ['promises', 'is_active'];

    protected $casts = [
        'promises' => 'array', // cast JSON to array automatically
        'is_active' => 'boolean',
    ];
}
