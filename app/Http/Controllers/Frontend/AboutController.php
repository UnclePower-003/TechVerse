<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutHero;

class AboutController extends Controller
{
    public function index()
    {
        $hero = AboutHero::where('is_active', true)->latest()->first();

        return view('frontend.pages.about', compact('hero'));
    }
}
