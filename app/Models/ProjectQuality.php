<?php

// app/Models/ProjectQuality.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectQuality extends Model
{
    protected $fillable = ['icon', 'title', 'description', 'delay', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
