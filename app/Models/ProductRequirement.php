<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'phone', 'interest', 'message', 'is_read'];
}
