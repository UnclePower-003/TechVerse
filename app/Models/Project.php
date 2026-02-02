<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = ['title', 'subtitle', 'image', 'badge', 'overview', 'project_specifications', 'completion', 'key_features', 'technical_details', 'quote', 'quote_author'];

    // Cast JSON columns to array
    protected $casts = [
        'project_specifications' => 'array',
        'key_features' => 'array',
    ];
}
