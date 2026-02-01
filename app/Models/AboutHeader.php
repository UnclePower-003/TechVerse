<?php

// app/Models/AboutHeader.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutHeader extends Model
{
    protected $fillable = ['title', 'description', 'badge_text', 'badge_icon', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
