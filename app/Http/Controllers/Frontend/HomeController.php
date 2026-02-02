<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use App\Models\HeroHeader;
use App\Models\HomeStat;
use App\Models\ServiceList;
use App\Models\HomePartner;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HomeHero::where('is_active', true)->latest()->first();

        $heroHeader = HeroHeader::where('is_active', true)->latest()->first();

        $stats = HomeStat::orderBy('position')->get();

        $services = ServiceList::where('is_active', true)->orderBy('id')->get();

        $partners = HomePartner::where('is_active', true)->get();

        $info = ContactInfo::where('is_active', true)->latest()->first();

        $projects = Project::orderBy('id', 'asc')->get(); // Get all projects, latest first

        return view('frontend.pages.home', compact('hero', 'heroHeader', 'stats', 'services', 'partners', 'info', 'projects'));
    }
}
