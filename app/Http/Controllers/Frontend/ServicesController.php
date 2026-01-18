<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServicesHero;
use App\Models\ServiceHeader;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $hero = ServicesHero::where('is_active', true)->latest()->first();

        $header = ServiceHeader::where('is_active', true)->latest()->first();

        return view('frontend.pages.services', compact('hero', 'header'));
    }
}
