<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroHeader extends Model
{
    use HasFactory;

    protected $fillable = ['badge_text', 'title_small_1', 'title_main', 'title_small_2', 'title_highlight', 'description', 'primary_btn_text', 'primary_btn_link', 'secondary_btn_text', 'secondary_btn_link', 'is_active'];
}
