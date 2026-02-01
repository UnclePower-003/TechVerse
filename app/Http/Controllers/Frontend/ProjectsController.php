<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectHero;
use App\Models\ProjectHeader;

class ProjectsController extends Controller
{
    public function index()
    {
        $hero = ProjectHero::where('is_active', true)->latest()->first();

        $header = ProjectHeader::where('is_active', true)->latest()->first();

        return view('frontend.pages.projects', compact('hero', 'header'));
    }
}
