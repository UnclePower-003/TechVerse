<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerComponent extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price', 'image_url', 'in_stock', 'specifications', 'is_active', 'sort_order'];

    protected $casts = [
        'price' => 'decimal:2',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
        'specifications' => 'array',
    ];

    /**
     * Get the category this component belongs to
     */
    public function category()
    {
        return $this->belongsTo(ServerCategory::class, 'category_id');
    }

    /**
     * Get configuration items using this component
     */
    public function configurationItems()
    {
        return $this->hasMany(ConfigurationItem::class, 'component_id');
    }
}
