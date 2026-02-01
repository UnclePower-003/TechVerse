<?php

// app/Models/ProjectHero.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHero extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'is_active'];
}
