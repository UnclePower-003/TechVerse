<?php

// app/Models/ProjectHeader.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectHeader extends Model
{
    protected $fillable = ['small_title', 'main_title', 'description', 'badges', 'is_active'];

    protected $casts = [
        'badges' => 'array', // IMPORTANT
        'is_active' => 'boolean',
    ];
}
