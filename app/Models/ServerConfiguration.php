<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerConfiguration extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'customer_email', 'customer_phone', 'company_name', 'notes', 'selections', 'total_price', 'status'];

    protected $casts = [
        'selections' => 'array',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the configuration items
     */
    public function items()
    {
        return $this->hasMany(ConfigurationItem::class, 'configuration_id');
    }

    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_REVIEWED = 'reviewed';
    const STATUS_QUOTED = 'quoted';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'completed';

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'quoted' => 'purple',
            'approved' => 'green',
            'rejected' => 'red',
            'completed' => 'gray',
            default => 'gray',
        };
    }
}
