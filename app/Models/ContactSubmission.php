<?php

// app/Models/ContactSubmission.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = ['full_name', 'phone', 'email', 'inquiry_type', 'message', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
