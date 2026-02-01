<?php

// app/Models/AboutPromise.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPromise extends Model
{
    protected $fillable = ['icon', 'title', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
