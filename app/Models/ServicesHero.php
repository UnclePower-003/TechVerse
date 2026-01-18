<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesHero extends Model
{
    use HasFactory;

    protected $fillable = ['mobile_image', 'tablet_image', 'desktop_image', 'is_active'];
}
