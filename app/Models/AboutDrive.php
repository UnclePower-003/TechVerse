<?php

// app/Models/AboutDrive.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutDrive extends Model
{
    protected $fillable = ['title', 'description', 'points', 'is_active'];

    protected $casts = [
        'points' => 'array', // JSON → array automatically
        'is_active' => 'boolean',
    ];
}
