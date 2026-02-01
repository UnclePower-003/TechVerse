<?php

// app/Models/AboutExpertise.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutExpertise extends Model
{
    protected $fillable = ['title', 'description', 'items', 'is_active'];

    protected $casts = [
        'items' => 'array', // automatically converts JSON to array
        'is_active' => 'boolean',
    ];
}
