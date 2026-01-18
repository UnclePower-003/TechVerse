<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HomeHero::where('is_active', true)->latest()->first();

        return view('frontend.pages.home', compact('hero'));
    }
}
