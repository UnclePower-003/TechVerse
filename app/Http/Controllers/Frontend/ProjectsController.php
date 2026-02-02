<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectHero;
use App\Models\ProjectHeader;
use App\Models\ProjectQuality;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $hero = ProjectHero::where('is_active', true)->latest()->first();

        $header = ProjectHeader::where('is_active', true)->latest()->first();

        $qualities = ProjectQuality::where('is_active', true)->orderBy('delay')->get();

        $projects = Project::orderBy('id', 'asc')->get(); // Get all projects, latest first

        return view('frontend.pages.projects', compact('hero', 'header', 'qualities', 'projects'));
    }

    public function show(Project $project)
    {
        return view('frontend.pages.cardsdetails', compact('project'));
    }
}
