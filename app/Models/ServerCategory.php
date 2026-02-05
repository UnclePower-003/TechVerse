<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'required', 'is_active', 'sort_order'];

    protected $casts = [
        'required' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get components for this category
     */
    public function components()
    {
        return $this->hasMany(ServerComponent::class, 'category_id');
    }

    /**
     * Get active components only
     */
    public function activeComponents()
    {
        return $this->hasMany(ServerComponent::class, 'category_id')->where('is_active', true)->orderBy('sort_order');
    }
}
