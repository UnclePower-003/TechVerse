<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationItem extends Model
{
    use HasFactory;

    protected $fillable = ['configuration_id', 'category_id', 'component_id', 'component_name', 'price'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the configuration this item belongs to
     */
    public function configuration()
    {
        return $this->belongsTo(ServerConfiguration::class, 'configuration_id');
    }

    /**
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo(ServerCategory::class, 'category_id');
    }

    /**
     * Get the component
     */
    public function component()
    {
        return $this->belongsTo(ServerComponent::class, 'component_id');
    }
}
