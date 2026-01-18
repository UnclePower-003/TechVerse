<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactChoose extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'description', 'order'];
}
