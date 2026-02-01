<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutHero;
use App\Models\AboutHeader;
use App\Models\AboutExpertise;
use App\Models\AboutDrive;

class AboutController extends Controller
{
    public function index()
    {
        $hero = AboutHero::where('is_active', true)->latest()->first();

        $header = AboutHeader::where('is_active', true)->latest()->first();

        $expertise = AboutExpertise::where('is_active', true)->latest()->first();

        $drive = AboutDrive::where('is_active', true)->latest()->first();

        return view('frontend.pages.about', compact('hero', 'header', 'expertise', 'drive'));
    }
}
