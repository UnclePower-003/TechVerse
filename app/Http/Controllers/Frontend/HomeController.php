<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use App\Models\HeroHeader;
use App\Models\HomeStat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HomeHero::where('is_active', true)->latest()->first();

        $heroHeader = HeroHeader::where('is_active', true)->latest()->first();

        $stats = HomeStat::orderBy('position')->get();

        return view('frontend.pages.home', compact('hero', 'heroHeader', 'stats'));
    }
}
